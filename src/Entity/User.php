<?php

namespace Tanya\Mysite\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use IteratorAggregate;
use ArrayIterator;
use Traversable;

#[ORM\Entity]
#[ORM\Table(name: "Users")]
class User implements IteratorAggregate
{
     #[ORM\Id]
     #[ORM\GeneratedValue]
     #[ORM\Column(type: "integer")]
     public ?int $id = null;

    #[ORM\Column(type: "string")]
    #[Assert\NotBlank(message:"Имя не может быть пустым.")]
    public string $login;

    #[ORM\Column(type:"string")]
    public  string $password;

    #[ORM\Column(type: "string")]
    #[Assert\NotBlank(message:"Email не может быть пустым.")]
    #[Assert\Email(message:"Не корректный email.")]
    public string $email;
    
   #[ORM\Column(type: "string", nullable: true)]
    public ?string $picture;

    public function getIterator(): Traversable
    {
        return new ArrayIterator([
            'id'       => $this -> id,
            'login'    => $this -> login,
            'password' => $this -> password,
            'email'    => $this -> email,
            'picture'  => $this -> picture
        ]);

    }

    public function uploadImage()
    {
        $uploads_dir = IMAGES_DIR;
        if (!is_dir($uploads_dir)) {
            mkdir($uploads_dir);
        }
        if(!isset($_FILES["profile"])){
        return false;
        }
        $error = $_FILES["profile"]["error"];
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["profile"]["tmp_name"];
            $extension = pathinfo($_FILES["profile"]["name"], PATHINFO_EXTENSION);
            $this->picture = md5(date_create()->format('Unix Timestamp')) . '.' . $extension;
            return move_uploaded_file($tmp_name, "$uploads_dir/{$this->picture}");
        }
        return false;
    }
    
}