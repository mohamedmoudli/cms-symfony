<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use App\Trait\DateTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Projet
{
    use DateTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\OneToMany(mappedBy: 'projet', targetEntity: Form::class)]
    private Collection $forms;

    #[ORM\OneToMany(mappedBy: 'projet', targetEntity: FormTotaux::class)]
    private Collection $formTotauxes;

    #[ORM\OneToMany(mappedBy: 'projet', targetEntity: FormChamps::class)]
    private Collection $formChamps;

    #[ORM\OneToMany(mappedBy: 'projet', targetEntity: FormEtat::class)]
    private Collection $formEtats;

    #[ORM\OneToMany(mappedBy: 'projet', targetEntity: MonetiqueDroit::class)]
    private Collection $monetiqueDroits;

    public function __construct()
    {
        $this->forms = new ArrayCollection();
        $this->formTotauxes = new ArrayCollection();
        $this->formChamps = new ArrayCollection();
        $this->formEtats = new ArrayCollection();
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

    /**
     * @return Collection<int, Form>
     */
    public function getForms(): Collection
    {
        return $this->forms;
    }

    public function addForm(Form $form): static
    {
        if (!$this->forms->contains($form)) {
            $this->forms->add($form);
            $form->setProjet($this);
        }

        return $this;
    }

    public function removeForm(Form $form): static
    {
        if ($this->forms->removeElement($form)) {
            // set the owning side to null (unless already changed)
            if ($form->getProjet() === $this) {
                $form->setProjet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FormTotaux>
     */
    public function getFormTotauxes(): Collection
    {
        return $this->formTotauxes;
    }

    public function addFormTotaux(FormTotaux $formTotaux): static
    {
        if (!$this->formTotauxes->contains($formTotaux)) {
            $this->formTotauxes->add($formTotaux);
            $formTotaux->setProjet($this);
        }

        return $this;
    }

    public function removeFormTotaux(FormTotaux $formTotaux): static
    {
        if ($this->formTotauxes->removeElement($formTotaux)) {
            // set the owning side to null (unless already changed)
            if ($formTotaux->getProjet() === $this) {
                $formTotaux->setProjet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FormChamps>
     */
    public function getFormChamps(): Collection
    {
        return $this->formChamps;
    }

    public function addFormChamp(FormChamps $formChamp): static
    {
        if (!$this->formChamps->contains($formChamp)) {
            $this->formChamps->add($formChamp);
            $formChamp->setProjet($this);
        }

        return $this;
    }

    public function removeFormChamp(FormChamps $formChamp): static
    {
        if ($this->formChamps->removeElement($formChamp)) {
            // set the owning side to null (unless already changed)
            if ($formChamp->getProjet() === $this) {
                $formChamp->setProjet(null);
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
            $formEtat->setProjet($this);
        }

        return $this;
    }

    public function removeFormEtat(FormEtat $formEtat): static
    {
        if ($this->formEtats->removeElement($formEtat)) {
            // set the owning side to null (unless already changed)
            if ($formEtat->getProjet() === $this) {
                $formEtat->setProjet(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return $this->label;
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
            $monetiqueDroit->setProjet($this);
        }

        return $this;
    }

    public function removeMonetiqueDroit(MonetiqueDroit $monetiqueDroit): static
    {
        if ($this->monetiqueDroits->removeElement($monetiqueDroit)) {
            // set the owning side to null (unless already changed)
            if ($monetiqueDroit->getProjet() === $this) {
                $monetiqueDroit->setProjet(null);
            }
        }

        return $this;
    }
}
