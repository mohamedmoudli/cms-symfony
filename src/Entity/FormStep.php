<?php

namespace App\Entity;

use App\Repository\FormStepRepository;
use App\Trait\DateTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormStepRepository::class)]
#[ORM\HasLifecycleCallbacks]
class FormStep
{
    use DateTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?int $ordre = null;

    #[ORM\Column(nullable: true)]
    private ?bool $actif = null;

    #[ORM\Column(nullable: true)]
    private ?bool $save = null;

    #[ORM\ManyToOne(inversedBy: 'formSteps')]
    private ?Form $form = null;

    #[ORM\OneToMany(mappedBy: 'formStep', targetEntity: FormStepChamps::class)]
    private Collection $formStepChamps;

    public function __construct()
    {
        $this->formStepChamps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

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

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(?int $ordre): static
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(?bool $actif): static
    {
        $this->actif = $actif;

        return $this;
    }

    public function isSave(): ?bool
    {
        return $this->save;
    }

    public function setSave(?bool $save): static
    {
        $this->save = $save;

        return $this;
    }

    public function getForm(): ?Form
    {
        return $this->form;
    }

    public function setForm(?Form $form): static
    {
        $this->form = $form;

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
            $formStepChamp->setFormStep($this);
        }

        return $this;
    }

    public function removeFormStepChamp(FormStepChamps $formStepChamp): static
    {
        if ($this->formStepChamps->removeElement($formStepChamp)) {
            // set the owning side to null (unless already changed)
            if ($formStepChamp->getFormStep() === $this) {
                $formStepChamp->setFormStep(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return $this->titre;
    }
}
