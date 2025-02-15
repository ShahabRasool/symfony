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
    // owing side is the one which has the foriegn key
    #[ORM\OneToOne(inversedBy: 'passport', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?citizen $citizen = null;

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

    public function getCitizen(): ?citizen
    {
        return $this->citizen;
    }

    public function setCitizen(citizen $citizen): static
    {
        $this->citizen = $citizen;

        return $this;
    }
}
