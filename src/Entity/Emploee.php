<?php

namespace App\Entity;

use App\Repository\EmploeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmploeeRepository::class)]
class Emploee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $fathername = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'emploees')]
    private ?self $manager = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'manager')]
    private Collection $emploees;

    public function __construct()
    {
        $this->emploees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFathername(): ?string
    {
        return $this->fathername;
    }

    public function setFathername(string $fathername): static
    {
        $this->fathername = $fathername;

        return $this;
    }

    public function getManager(): ?self
    {
        return $this->manager;
    }

    public function setManager(?self $manager): static
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getEmploees(): Collection
    {
        return $this->emploees;
    }

    public function addEmploee(self $emploee): static
    {
        if (!$this->emploees->contains($emploee)) {
            $this->emploees->add($emploee);
            $emploee->setManager($this);
        }

        return $this;
    }

    public function removeEmploee(self $emploee): static
    {
        if ($this->emploees->removeElement($emploee)) {
            // set the owning side to null (unless already changed)
            if ($emploee->getManager() === $this) {
                $emploee->setManager(null);
            }
        }

        return $this;
    }
}
