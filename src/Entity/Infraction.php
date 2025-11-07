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

    #[ORM\Column(length: 20)]
    private string $type; // "amende" ou "penalite"

    #[ORM\Column(nullable: true)]
    private ?float $montant = null; // si amende

    #[ORM\Column(nullable: true)]
    private ?int $points = null; // si pénalité

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: 'text')]
    private ?string $description = null;

    #[ORM\Column(length: 100)]
    private ?string $course = null;

    #[ORM\ManyToOne(inversedBy: 'infractions')]
    private ?Pilote $pilote = null;

    #[ORM\ManyToOne(inversedBy: 'infractions')]
    private ?Ecurie $ecurie = null;

    public function getId(): ?int { return $this->id; }
    public function getType(): ?string { return $this->type; }
    public function setType(string $type): self { $this->type = $type; return $this; }

    public function getMontant(): ?float { return $this->montant; }
    public function setMontant(?float $montant): self { $this->montant = $montant; return $this; }

    public function getPoints(): ?int { return $this->points; }
    public function setPoints(?int $points): self { $this->points = $points; return $this; }

    public function getDate(): ?\DateTimeInterface { return $this->date; }
    public function setDate(\DateTimeInterface $date): self { $this->date = $date; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(string $description): self { $this->description = $description; return $this; }

    public function getCourse(): ?string { return $this->course; }
    public function setCourse(string $course): self { $this->course = $course; return $this; }

    public function getPilote(): ?Pilote { return $this->pilote; }
    public function setPilote(?Pilote $pilote): self { $this->pilote = $pilote; return $this; }

    public function getEcurie(): ?Ecurie { return $this->ecurie; }
    public function setEcurie(?Ecurie $ecurie): self { $this->ecurie = $ecurie; return $this; }
}
