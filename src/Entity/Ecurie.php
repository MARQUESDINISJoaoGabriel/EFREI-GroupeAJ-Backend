<?php

namespace App\Entity;

use App\Repository\EcurieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EcurieRepository::class)]
class Ecurie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, unique: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $moteur = null;

    #[ORM\OneToMany(mappedBy: 'ecurie', targetEntity: Pilote::class, cascade: ['persist', 'remove'])]
    private Collection $pilotes;

    #[ORM\OneToMany(mappedBy: 'ecurie', targetEntity: Infraction::class)]
    private Collection $infractions;

    public function __construct()
    {
        $this->pilotes = new ArrayCollection();
        $this->infractions = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): self { $this->nom = $nom; return $this; }

    public function getMoteur(): ?string { return $this->moteur; }
    public function setMoteur(string $moteur): self { $this->moteur = $moteur; return $this; }

    /** @return Collection<int, Pilote> */
    public function getPilotes(): Collection { return $this->pilotes; }

    public function addPilote(Pilote $pilote): self
    {
        if (!$this->pilotes->contains($pilote)) {
            $this->pilotes->add($pilote);
            $pilote->setEcurie($this);
        }
        return $this;
    }

    public function removePilote(Pilote $pilote): self
    {
        if ($this->pilotes->removeElement($pilote)) {
            if ($pilote->getEcurie() === $this) {
                $pilote->setEcurie(null);
            }
        }
        return $this;
    }
}
