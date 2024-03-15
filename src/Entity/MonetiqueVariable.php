<?php

namespace App\Entity;

use App\Repository\MonetiqueVariableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MonetiqueVariableRepository::class)]
class MonetiqueVariable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'monetiqueVariables')]
    private ?Monetique $monetique = null;

    #[ORM\OneToMany(mappedBy: 'monetiqueVariable', targetEntity: MonetiqueDroitVariable::class)]
    private Collection $monetiqueDroitVariables;

    public function __construct()
    {
        $this->monetiqueDroitVariables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $monetiqueDroitVariable->setMonetiqueVariable($this);
        }

        return $this;
    }

    public function removeMonetiqueDroitVariable(MonetiqueDroitVariable $monetiqueDroitVariable): static
    {
        if ($this->monetiqueDroitVariables->removeElement($monetiqueDroitVariable)) {
            // set the owning side to null (unless already changed)
            if ($monetiqueDroitVariable->getMonetiqueVariable() === $this) {
                $monetiqueDroitVariable->setMonetiqueVariable(null);
            }
        }

        return $this;
    }
}
