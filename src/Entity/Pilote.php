<?php

namespace App\Entity;

use App\Repository\PiloteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PiloteRepository::class)]
class Pilote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column]
    private int $points = 12;

    #[ORM\Column(length: 20)]
    private string $statut = 'titulaire';

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $dateDebutF1 = null;

    #[ORM\ManyToOne(inversedBy: 'pilotes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ecurie $ecurie = null;

    #[ORM\OneToMany(mappedBy: 'pilote', targetEntity: Infraction::class)]
    private Collection $infractions;

    public function __construct()
    {
        $this->infractions = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getPrenom(): ?string { return $this->prenom; }
    public function setPrenom(string $prenom): self { $this->prenom = $prenom; return $this; }

    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): self { $this->nom = $nom; return $this; }

    public function getPoints(): int { return $this->points; }
    public function setPoints(int $points): self { $this->points = $points; return $this; }

    public function getStatut(): string { return $this->statut; }
    public function setStatut(string $statut): self { $this->statut = $statut; return $this; }

    public function getDateDebutF1(): ?\DateTimeInterface { return $this->dateDebutF1; }
    public function setDateDebutF1(\DateTimeInterface $date): self { $this->dateDebutF1 = $date; return $this; }

    public function getEcurie(): ?Ecurie { return $this->ecurie; }
    public function setEcurie(?Ecurie $ecurie): self { $this->ecurie = $ecurie; return $this; }
}
