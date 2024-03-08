<?php

namespace App\Entity;

use App\Repository\FormRepository;
use App\Trait\DateTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Form
{
    use DateTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descriptionDebut = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descriptionFin = null;

    #[ORM\ManyToOne(inversedBy: 'forms')]
    private ?Projet $projet = null;

    #[ORM\OneToMany(mappedBy: 'form', targetEntity: FormStep::class)]
    private Collection $formSteps;

    #[ORM\OneToMany(mappedBy: 'form', targetEntity: FormEtat::class)]
    private Collection $formEtats;

    #[ORM\Column(nullable: true)]
    private ?int $biblio = null;



    public function __construct()
    {
        $this->formSteps = new ArrayCollection();
        $this->formEtats = new ArrayCollection();
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

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescriptionDebut(): ?string
    {
        return $this->descriptionDebut;
    }

    public function setDescriptionDebut(string $description_debut): static
    {
        $this->descriptionDebut = $description_debut;

        return $this;
    }

    public function getDescriptionFin(): ?string
    {
        return $this->descriptionFin;
    }

    public function setDescriptionFin(string $description_fin): static
    {
        $this->descriptionFin = $description_fin;

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

    /**
     * @return Collection<int, FormStep>
     */
    public function getFormSteps(): Collection
    {
        return $this->formSteps;
    }

    public function addFormStep(FormStep $formStep): static
    {
        if (!$this->formSteps->contains($formStep)) {
            $this->formSteps->add($formStep);
            $formStep->setForm($this);
        }

        return $this;
    }

    public function removeFormStep(FormStep $formStep): static
    {
        if ($this->formSteps->removeElement($formStep)) {
            // set the owning side to null (unless already changed)
            if ($formStep->getForm() === $this) {
                $formStep->setForm(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FormEtat>
     */
    public function getFormEtats(): Collection
    {
        return $this->formEtats;
    }

    public function addFormEtat(FormEtat $formEtat): static
    {
        if (!$this->formEtats->contains($formEtat)) {
            $this->formEtats->add($formEtat);
            $formEtat->setForm($this);
        }

        return $this;
    }

    public function removeFormEtat(FormEtat $formEtat): static
    {
        if ($this->formEtats->removeElement($formEtat)) {
            // set the owning side to null (unless already changed)
            if ($formEtat->getForm() === $this) {
                $formEtat->setForm(null);
            }
        }

        return $this;
    }

    public function getBiblio(): ?int
    {
        return $this->biblio;
    }

    public function setBiblio(?int $biblio): static
    {
        $this->biblio = $biblio;

        return $this;
    }
    public function __toString(){
        return $this->label;
    }

}
