<?php

namespace App\Entity;

use App\Repository\MonetiqueDroitVariableRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MonetiqueDroitVariableRepository::class)]
class MonetiqueDroitVariable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'monetiqueDroitVariables')]
    private ?MonetiqueDroit $monetiqueDroit = null;

    #[ORM\ManyToOne(inversedBy: 'monetiqueDroitVariables')]
    private ?MonetiqueVariable $monetiqueVariable = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $valeur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMonetiqueDroit(): ?MonetiqueDroit
    {
        return $this->monetiqueDroit;
    }

    public function setMonetiqueDroit(?MonetiqueDroit $monetiqueDroit): static
    {
        $this->monetiqueDroit = $monetiqueDroit;

        return $this;
    }

    public function getMonetiqueVariable(): ?MonetiqueVariable
    {
        return $this->monetiqueVariable;
    }

    public function setMonetiqueVariable(?MonetiqueVariable $monetiqueVariable): static
    {
        $this->monetiqueVariable = $monetiqueVariable;

        return $this;
    }

    public function getValeur(): ?string
    {
        return $this->valeur;
    }

    public function setValeur(string $valeur): static
    {
        $this->valeur = $valeur;

        return $this;
    }
    public function __toString(){
        return $this->valeur;
    }
}
