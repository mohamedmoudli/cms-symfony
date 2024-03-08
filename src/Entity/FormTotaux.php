<?php

namespace App\Entity;

use App\Repository\FormTotauxRepository;
use App\Trait\DateTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormTotauxRepository::class)]
#[ORM\HasLifecycleCallbacks]
class FormTotaux
{
    use DateTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $label = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $unite = null;

    #[ORM\ManyToOne(inversedBy: 'formTotauxes')]
    private ?Projet $projet = null;

    #[ORM\OneToMany(mappedBy: 'formToTaux', targetEntity: FormChamps::class)]
    private Collection $formChamps;

    public function __construct()
    {
        $this->formChamps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getUnite(): ?string
    {
        return $this->unite;
    }

    public function setUnite(string $unite): static
    {
        $this->unite = $unite;

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
            $formChamp->setFormToTaux($this);
        }

        return $this;
    }

    public function removeFormChamp(FormChamps $formChamp): static
    {
        if ($this->formChamps->removeElement($formChamp)) {
            // set the owning side to null (unless already changed)
            if ($formChamp->getFormToTaux() === $this) {
                $formChamp->setFormToTaux(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return $this->label;
    }
}
