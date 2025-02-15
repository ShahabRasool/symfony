<?php

namespace App\Entity;

use App\Repository\PassportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PassportRepository::class)]
class Passport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $passnum = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassnum(): ?string
    {
        return $this->passnum;
    }

    public function setPassnum(string $passnum): static
    {
        $this->passnum = $passnum;

        return $this;
    }
}
