<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "users")]
class User
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
}