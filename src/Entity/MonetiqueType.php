<?php

namespace App\Entity;

use App\Repository\MonetiqueTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MonetiqueTypeRepository::class)]
class MonetiqueType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    private ?string $variable = null;

    #[ORM\OneToMany(mappedBy: 'monetiqueType', targetEntity: FormTotaux::class)]
    private Collection $formTotauxes;

    public function __construct()
    {
        $this->formTotauxes = new ArrayCollection();
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

    public function getVariable(): ?string
    {
        return $this->variable;
    }

    public function setVariable(string $variable): static
    {
        $this->variable = $variable;

        return $this;
    }
    public function __toString(){
        return $this->label;
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
            $formTotaux->setMonetiqueType($this);
        }

        return $this;
    }

    public function removeFormTotaux(FormTotaux $formTotaux): static
    {
        if ($this->formTotauxes->removeElement($formTotaux)) {
            // set the owning side to null (unless already changed)
            if ($formTotaux->getMonetiqueType() === $this) {
                $formTotaux->setMonetiqueType(null);
            }
        }

        return $this;
    }
}
