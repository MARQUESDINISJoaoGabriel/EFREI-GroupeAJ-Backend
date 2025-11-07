<?php

namespace App\Entity;

use App\Repository\InfractionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InfractionRepository::class)]
class Infraction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(nullable: true)]
    private ?float $montant = null;

    #[ORM\Column(nullable: true)]
    private ?int $points = null;

    #[ORM\Column]
    private ?\DateTime $date = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $course = null;

    #[ORM\Column(nullable: true)]
    private ?int $pilote = null;

    #[ORM\Column(nullable: true)]
    private ?int $ecurie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(?float $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(?int $points): static
    {
        $this->points = $points;

        return $this;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;

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

    public function getCourse(): ?string
    {
        return $this->course;
    }

    public function setCourse(string $course): static
    {
        $this->course = $course;

        return $this;
    }

    public function getPilote(): ?int
    {
        return $this->pilote;
    }

    public function setPilote(?int $pilote): static
    {
        $this->pilote = $pilote;

        return $this;
    }

    public function getEcurie(): ?int
    {
        return $this->ecurie;
    }

    public function setEcurie(?int $ecurie): static
    {
        $this->ecurie = $ecurie;

        return $this;
    }
}
