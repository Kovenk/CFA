<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $intitule;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Formateur", mappedBy="specialite")
     */
    private $specialite;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Module", mappedBy="theme", orphanRemoval=true)
     */
    private $compositionTheme;

    public function __construct()
    {
        $this->specialite = new ArrayCollection();
        $this->compositionTheme = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * @return Collection|Formateur[]
     */
    public function getSpecialite(): Collection
    {
        return $this->specialite;
    }

    public function addSpecialite(Formateur $specialite): self
    {
        if (!$this->specialite->contains($specialite)) {
            $this->specialite[] = $specialite;
            $specialite->setSpecialite($this);
        }

        return $this;
    }

    public function removeSpecialite(Formateur $specialite): self
    {
        if ($this->specialite->contains($specialite)) {
            $this->specialite->removeElement($specialite);
            // set the owning side to null (unless already changed)
            if ($specialite->getSpecialite() === $this) {
                $specialite->setSpecialite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Module[]
     */
    public function getCompositionTheme(): Collection
    {
        return $this->compositionTheme;
    }

    public function addCompositionTheme(Module $compositionTheme): self
    {
        if (!$this->compositionTheme->contains($compositionTheme)) {
            $this->compositionTheme[] = $compositionTheme;
            $compositionTheme->setTheme($this);
        }

        return $this;
    }

    public function removeCompositionTheme(Module $compositionTheme): self
    {
        if ($this->compositionTheme->contains($compositionTheme)) {
            $this->compositionTheme->removeElement($compositionTheme);
            // set the owning side to null (unless already changed)
            if ($compositionTheme->getTheme() === $this) {
                $compositionTheme->setTheme(null);
            }
        }

        return $this;
    }
}
