<?php

namespace App\Entity;

use App\Repository\FormStepChampsRepository;
use App\Trait\DateTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormStepChampsRepository::class)]
#[ORM\HasLifecycleCallbacks]
class FormStepChamps
{
    use DateTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $ordre = null;

    #[ORM\Column]
    private ?bool $actif = null;

    #[ORM\Column]
    private ?bool $obligatoire = null;

    #[ORM\ManyToOne(inversedBy: 'formStepChamps')]
    private ?FormStep $formStep = null;

    #[ORM\ManyToOne(inversedBy: 'formStepChamps')]
    private ?FormChamps $formChamps = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): static
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): static
    {
        $this->actif = $actif;

        return $this;
    }

    public function isObligatoire(): ?bool
    {
        return $this->obligatoire;
    }

    public function setObligatoire(bool $obligatoire): static
    {
        $this->obligatoire = $obligatoire;

        return $this;
    }

    public function getFormStep(): ?FormStep
    {
        return $this->formStep;
    }

    public function setFormStep(?FormStep $formStep): static
    {
        $this->formStep = $formStep;

        return $this;
    }

    public function getFormChamps(): ?FormChamps
    {
        return $this->formChamps;
    }

    public function setFormChamps(?FormChamps $formChamps): static
    {
        $this->formChamps = $formChamps;

        return $this;
    }
    public function __toString(){
        return $this->ordre;
    }
}
