<?php

namespace Tanya\Mysite\controllers;

use Symfony\Component\Validator\Validation;
use Tanya\Mysite\core\Controller;
use Tanya\Mysite\models\User;
use Tanya\Mysite\Entity\User as EntityUser;

class UserController extends Controller
{
    function addAction()
    {
        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';
        $email = $_POST['email'] ?? '';

        $user = new User($login, $password, $email);
        if  ($user-> validate()){
            $user->upload_image();
             $id = $user->addUser();
             return $this->redirect("user/show/$id");
        }
        $this->render('addUser', ['errors' => $user->errors]);
    }

    function loginAction()
    {
        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';
        // var_dump($login, $password);

        $user = new User($login, $password);
        if ($user->login()) {
           $this->redirect();
           return;
        }

        $this->render('login', ['errors' => $user->errors]);
    }

    function editAction($id = 0){
        // if($id > 0){
        //     $login = $_POST['login'] ?? '';

        //     $email = $_POST['email'] ?? '';
        //     $userRepository = $this->entityManager->getRepository(EntityUser::class);
        //     $user = $userRepository->find($id);
        //     //
        //     $this->render('editUser', ['user' => $user]);
        // }else {
        //     $this->redirect('user/show');
        // }

        if($id > 0){
            $login = $_POST['login'] ?? '';
            $email = $_POST['email'] ?? '';
            $errors = [];
            $userRepository = $this->entityManager->getRepository(EntityUser::class);
            $user = $userRepository->find($id);

            //Валидация сущности
            if ($login || $email){
                $user->login = $login;
                $user->email = $email;
                $violations = $this->validator->validate($user);

                foreach ($violations as $violation){
                    $property = $violation->getPropertyPath();
                    $errors[$property] = $violation->getMessage();
                }
                if (empty($errors)){
                  $this->entityManager->flush();
                  return $this->redirect('user/show/1');
                }
            }
            
            $this->render('editUser', ['user' => $user, 'errors' => $errors]);
        }else {
            $this->redirect('user/add');
        }
    }

    function showAction($id = 0)
    {
        // $user = new User();
        // $users = $user->readUsers($id);
        $userRepository = $this->entityManager->getRepository(\Tanya\Mysite\Entity\User::class);
        if($id > 0) {
            $users = [$userRepository->find($id)];
        }else
        {
            $users = $userRepository->findAll();
        }
        $this->render('showUsers', ['users' => $users]);
    }
}
