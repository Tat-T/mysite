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
}