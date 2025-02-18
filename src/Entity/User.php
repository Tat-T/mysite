<?php

namespace Tanya\Mysite\Entity;

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
     private ?int $id = null;

    #[ORM\Column(type: "string")]
    private string $login;

    #[ORM\Column(type:"string")]
    private  string $password;

    #[ORM\Column(type: "string")]
    private string $email;
    
   #[ORM\Column(type: "string", nullable: true)]
    private ?string $picture;

    public function getIterator(): Traversable
    {
        return new ArrayIterator([
            'id' => $this -> id,
            'login' => $this -> login,
            'password'=> $this -> password,
            'email' => $this -> email,
            'picture' => $this -> picture
        ]);

    }
}