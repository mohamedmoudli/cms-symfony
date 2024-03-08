<?php

namespace App\Entity;

use App\Repository\FormEtatVariableRepository;
use App\Trait\DateTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormEtatVariableRepository::class)]
#[ORM\HasLifecycleCallbacks]
class FormEtatVariable
{
    use DateTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    private ?string $nomVariable = null;

    #[ORM\Column(length: 255)]
    private ?string $typeInput = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $valeur = null;

    #[ORM\ManyToOne(inversedBy: 'formEtatVariables')]
    private ?FormEtat $formEtat = null;

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

    public function getNomVariable(): ?string
    {
        return $this->nomVariable;
    }

    public function setNomVariable(string $nomVariable): static
    {
        $this->nomVariable = $nomVariable;

        return $this;
    }

    public function getTypeInput(): ?string
    {
        return $this->typeInput;
    }

    public function setTypeInput(string $typeInput): static
    {
        $this->typeInput = $typeInput;

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

    public function getFormEtat(): ?FormEtat
    {
        return $this->formEtat;
    }

    public function setFormEtat(?FormEtat $formEtat): static
    {
        $this->formEtat = $formEtat;

        return $this;
    }
    public function __toString(){
        return $this->label;
    }
}
