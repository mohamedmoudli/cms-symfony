<?php

namespace App\Entity;

use App\Repository\FormChampsOptionRepository;
use App\Trait\DateTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormChampsOptionRepository::class)]
#[ORM\HasLifecycleCallbacks]
class FormChampsOption
{
    use DateTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $option = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $valeur = null;

    #[ORM\Column]
    private ?int $ordre = null;

    #[ORM\Column]
    private ?bool $actif = null;

    #[ORM\ManyToOne(inversedBy: 'formChampsOptions')]
    private ?FormChamps $formChamps = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOption(): ?string
    {
        return $this->option;
    }

    public function setOption(string $option): static
    {
        $this->option = $option;

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

    public function getFormChamps(): ?FormChamps
    {
        return $this->formChamps;
    }

    public function setFormChamps(?FormChamps $formChamps): static
    {
        $this->formChamps = $formChamps;

        return $this;
    }
}
