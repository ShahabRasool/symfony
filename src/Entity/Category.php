<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoryRepository;
use Doctrine\DBAL\Types\Types;
#[ORM\Entity(repositoryClass:CategoryRepository::class)]
class Categroy {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
 private ?int $id=null;
 
    #[ORM\Column]
 private ?string $name=null;

 /**
  * Get the value of name
  */ 
 public function getName()
 {
  return $this->name;
 }

 /**
  * Set the value of name
  *
  * @return  self
  */ 
 public function setName($name)
 {
  $this->name = $name;

 }

 /**
  * Get the value of id
  */ 
 public function getId()
 {
  return $this->id;
 }
}