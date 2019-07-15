<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModuleRepository")
 */
class Module
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
     * @ORM\OneToMany(targetEntity="App\Entity\Duree", mappedBy="dureeIntoModule")
     */
    private $compositionSession;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="compositionTheme")
     * @ORM\JoinColumn(nullable=false)
     */
    private $theme;

    public function __construct()
    {
        $this->compositionSession = new ArrayCollection();
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
     * @return Collection|Duree[]
     */
    public function getCompositionSession(): Collection
    {
        return $this->compositionSession;
    }

    public function addCompositionSession(Duree $compositionSession): self
    {
        if (!$this->compositionSession->contains($compositionSession)) {
            $this->compositionSession[] = $compositionSession;
            $compositionSession->setDureeIntoModule($this);
        }

        return $this;
    }

    public function removeCompositionSession(Duree $compositionSession): self
    {
        if ($this->compositionSession->contains($compositionSession)) {
            $this->compositionSession->removeElement($compositionSession);
            // set the owning side to null (unless already changed)
            if ($compositionSession->getDureeIntoModule() === $this) {
                $compositionSession->setDureeIntoModule(null);
            }
        }

        return $this;
    }

    public function getTheme(): ?Categorie
    {
        return $this->theme;
    }

    public function setTheme(?Categorie $theme): self
    {
        $this->theme = $theme;

        return $this;
    }
}
