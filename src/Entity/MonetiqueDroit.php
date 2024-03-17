<?php

namespace App\Entity;

use App\Repository\MonetiqueDroitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MonetiqueDroitRepository::class)]
class MonetiqueDroit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'monetiqueDroits')]
    private ?Projet $projet = null;

    #[ORM\ManyToOne(inversedBy: 'monetiqueDroits')]
    private ?Monetique $monetique = null;

    #[ORM\OneToMany(mappedBy: 'monetiqueDroit', targetEntity: MonetiqueDroitVariable::class)]
    private Collection $monetiqueDroitVariables;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    public function __construct()
    {
        $this->monetiqueDroitVariables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): static
    {
        $this->projet = $projet;

        return $this;
    }

    public function getMonetique(): ?Monetique
    {
        return $this->monetique;
    }

    public function setMonetique(?Monetique $monetique): static
    {
        $this->monetique = $monetique;

        return $this;
    }

    /**
     * @return Collection<int, MonetiqueDroitVariable>
     */
    public function getMonetiqueDroitVariables(): Collection
    {
        return $this->monetiqueDroitVariables;
    }

    public function addMonetiqueDroitVariable(MonetiqueDroitVariable $monetiqueDroitVariable): static
    {
        if (!$this->monetiqueDroitVariables->contains($monetiqueDroitVariable)) {
            $this->monetiqueDroitVariables->add($monetiqueDroitVariable);
            $monetiqueDroitVariable->setMonetiqueDroit($this);
        }

        return $this;
    }

    public function removeMonetiqueDroitVariable(MonetiqueDroitVariable $monetiqueDroitVariable): static
    {
        if ($this->monetiqueDroitVariables->removeElement($monetiqueDroitVariable)) {
            // set the owning side to null (unless already changed)
            if ($monetiqueDroitVariable->getMonetiqueDroit() === $this) {
                $monetiqueDroitVariable->setMonetiqueDroit(null);
            }
        }

        return $this;
    }


    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }
    public function __toString(){
        return $this->label;
    }
}
