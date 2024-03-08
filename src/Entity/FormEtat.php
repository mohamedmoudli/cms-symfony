<?php

namespace App\Entity;

use App\Repository\FormEtatRepository;
use App\Trait\DateTrait;
use App\Entity\Form;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormEtatRepository::class)]
#[ORM\HasLifecycleCallbacks]
class FormEtat
{
    use DateTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $label = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $code_html = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $code_css = null;

    #[ORM\Column(type: Types::TEXT , nullable: true)]
    private ?string $code_compile_html = null;

    #[ORM\Column(type: Types::TEXT , nullable: true)]
    private ?string $codeCompileCss = null;

    #[ORM\ManyToOne(inversedBy: 'formEtats')]
    private ?Projet $projet = null;

    #[ORM\ManyToOne(inversedBy: 'formEtats')]
    private ?Form $form = null;

    #[ORM\OneToMany(mappedBy: 'formEtat', targetEntity: FormEtatVariable::class)]
    private Collection $formEtatVariables;

    public function __construct()
    {
        $this->formEtatVariables = new ArrayCollection();
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

    public function getCodeHtml(): ?string
    {
        return $this->code_html;
    }

    public function setCodeHtml(string $code_html): static
    {
        $this->code_html = $code_html;

        return $this;
    }

    public function getCodeCss(): ?string
    {
        return $this->code_css;
    }

    public function setCodeCss(string $code_css): static
    {
        $this->code_css = $code_css;

        return $this;
    }

    public function getCodeCompileHtml(): ?string
    {
        return $this->code_compile_html;
    }

    public function setCodeCompileHtml(?string $code_compile_html): static
    {
        $this->code_compile_html = $code_compile_html;

        return $this;
    }

    public function getCodeCompileCss(): ?string
    {
        return $this->codeCompileCss;
    }

    public function setCodeCompileCss(?string $codeCompileCss): static
    {
        $this->codeCompileCss = $codeCompileCss;

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
     * @return Collection<int, FormEtatVariable>
     */
    public function getFormEtatVariables(): Collection
    {
        return $this->formEtatVariables;
    }

    public function addFormEtatVariable(FormEtatVariable $formEtatVariable): static
    {
        if (!$this->formEtatVariables->contains($formEtatVariable)) {
            $this->formEtatVariables->add($formEtatVariable);
            $formEtatVariable->setFormEtat($this);
        }

        return $this;
    }

    public function removeFormEtatVariable(FormEtatVariable $formEtatVariable): static
    {
        if ($this->formEtatVariables->removeElement($formEtatVariable)) {
            // set the owning side to null (unless already changed)
            if ($formEtatVariable->getFormEtat() === $this) {
                $formEtatVariable->setFormEtat(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return $this->label;
    }
}
