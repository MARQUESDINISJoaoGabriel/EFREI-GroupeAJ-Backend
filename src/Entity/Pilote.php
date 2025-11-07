<?php

namespace App\Entity;

use App\Repository\PiloteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PiloteRepository::class)]
class Pilote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $points = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_debut_f1 = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\Column]
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): static
    {
        $this->points = $points;

        return $this;
    }

    public function getDateDebutF1(): ?\DateTime
    {
        return $this->date_debut_f1;
    }

    public function setDateDebutF1(\DateTime $date_debut_f1): static
    {
        $this->date_debut_f1 = $date_debut_f1;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getEcurie(): ?int
    {
        return $this->ecurie;
    }

    public function setEcurie(int $ecurie): static
    {
        $this->ecurie = $ecurie;

        return $this;
    }
}
