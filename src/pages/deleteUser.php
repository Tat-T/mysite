<?php

use Tanya\Mysite\Entity\User;
use Doctrine\ORM\EntityManager;

require_once __DIR__ . '/../../bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $userId = (int) $_POST['user_id'];

    /** @var EntityManager $entityManager */
    global $entityManager;

    $user = $entityManager->find(User::class, $userId);
    
    if ($user) {
        $entityManager->remove($user);
        $entityManager->flush();
        
        header("Location: /user/show"); 
        exit();
    } else {
        echo "Пользователь не найден.";
    }
}
