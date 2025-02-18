<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobRepository::class)]
class Job
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $iss_date = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $last_date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getIssDate(): ?\DateTimeImmutable
    {
        return $this->iss_date;
    }

    public function setIssDate(\DateTimeImmutable $iss_date): static
    {
        $this->iss_date = $iss_date;

        return $this;
    }

    public function getLastDate(): ?\DateTimeImmutable
    {
        return $this->last_date;
    }

    public function setLastDate(\DateTimeImmutable $last_date): static
    {
        $this->last_date = $last_date;

        return $this;
    }
}
