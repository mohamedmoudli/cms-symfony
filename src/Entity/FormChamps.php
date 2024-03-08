<?php

namespace App\Entity;

use App\Repository\FormChampsRepository;
use App\Trait\DateTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormChampsRepository::class)]
#[ORM\HasLifecycleCallbacks]
class FormChamps
{
    use DateTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $question = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::BOOLEAN)]
    private ?bool $actif = null;

    #[ORM\Column]
    private array $config = [];

    #[ORM\ManyToOne(inversedBy: 'formChamps')]
    private ?Projet $projet = null;

    #[ORM\ManyToOne(inversedBy: 'formChamps')]
    private ?FormTotaux $formToTaux = null;

    #[ORM\OneToMany(mappedBy: 'formChamps', targetEntity: FormStepChamps::class)]
    private Collection $formStepChamps;

    #[ORM\OneToMany(mappedBy: 'formChamps', targetEntity: FormChampsOption::class)]
    private Collection $formChampsOptions;

    public function __construct()
    {
        $this->formStepChamps = new ArrayCollection();
        $this->formChampsOptions = new ArrayCollection();
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

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    public function getConfig(): array
    {
        return $this->config;
    }

    public function setConfig(array $config): static
    {
        $this->config = $config;

        return $this;
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

    public function getFormToTaux(): ?FormTotaux
    {
        return $this->formToTaux;
    }

    public function setFormToTaux(?FormTotaux $formToTaux): static
    {
        $this->formToTaux = $formToTaux;

        return $this;
    }

    /**
     * @return Collection<int, FormStepChamps>
     */
    public function getFormStepChamps(): Collection
    {
        return $this->formStepChamps;
    }

    public function addFormStepChamp(FormStepChamps $formStepChamp): static
    {
        if (!$this->formStepChamps->contains($formStepChamp)) {
            $this->formStepChamps->add($formStepChamp);
            $formStepChamp->setFormChamps($this);
        }

        return $this;
    }

    public function removeFormStepChamp(FormStepChamps $formStepChamp): static
    {
        if ($this->formStepChamps->removeElement($formStepChamp)) {
            // set the owning side to null (unless already changed)
            if ($formStepChamp->getFormChamps() === $this) {
                $formStepChamp->setFormChamps(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FormChampsOption>
     */
    public function getFormChampsOptions(): Collection
    {
        return $this->formChampsOptions;
    }

    public function addFormChampsOption(FormChampsOption $formChampsOption): static
    {
        if (!$this->formChampsOptions->contains($formChampsOption)) {
            $this->formChampsOptions->add($formChampsOption);
            $formChampsOption->setFormChamps($this);
        }

        return $this;
    }

    public function removeFormChampsOption(FormChampsOption $formChampsOption): static
    {
        if ($this->formChampsOptions->removeElement($formChampsOption)) {
            // set the owning side to null (unless already changed)
            if ($formChampsOption->getFormChamps() === $this) {
                $formChampsOption->setFormChamps(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return $this->label;
    }
}
