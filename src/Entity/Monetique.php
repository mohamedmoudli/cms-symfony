<?php

namespace App\Entity;

use App\Repository\MonetiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MonetiqueRepository::class)]
class Monetique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $code = null;

    #[ORM\OneToMany(mappedBy: 'monetique', targetEntity: MonetiqueVariable::class)]
    private Collection $monetiqueVariables;

    #[ORM\OneToMany(mappedBy: 'monetique', targetEntity: MonetiqueDroit::class)]
    private Collection $monetiqueDroits;

    public function __construct()
    {
        $this->monetiqueVariables = new ArrayCollection();
        $this->monetiqueDroits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection<int, MonetiqueVariable>
     */
    public function getMonetiqueVariables(): Collection
    {
        return $this->monetiqueVariables;
    }

    public function addMonetiqueVariable(MonetiqueVariable $monetiqueVariable): static
    {
        if (!$this->monetiqueVariables->contains($monetiqueVariable)) {
            $this->monetiqueVariables->add($monetiqueVariable);
            $monetiqueVariable->setMonetique($this);
        }

        return $this;
    }

    public function removeMonetiqueVariable(MonetiqueVariable $monetiqueVariable): static
    {
        if ($this->monetiqueVariables->removeElement($monetiqueVariable)) {
            // set the owning side to null (unless already changed)
            if ($monetiqueVariable->getMonetique() === $this) {
                $monetiqueVariable->setMonetique(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MonetiqueDroit>
     */
    public function getMonetiqueDroits(): Collection
    {
        return $this->monetiqueDroits;
    }

    public function addMonetiqueDroit(MonetiqueDroit $monetiqueDroit): static
    {
        if (!$this->monetiqueDroits->contains($monetiqueDroit)) {
            $this->monetiqueDroits->add($monetiqueDroit);
            $monetiqueDroit->setMonetique($this);
        }

        return $this;
    }

    public function removeMonetiqueDroit(MonetiqueDroit $monetiqueDroit): static
    {
        if ($this->monetiqueDroits->removeElement($monetiqueDroit)) {
            // set the owning side to null (unless already changed)
            if ($monetiqueDroit->getMonetique() === $this) {
                $monetiqueDroit->setMonetique(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->label;
    }
}
