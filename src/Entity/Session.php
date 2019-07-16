<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 */
class Session
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
     * @ORM\Column(type="date")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFin;

    /**
     * @ORM\Column(type="integer")
     */
    private $placeTotale;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Stagiaire", inversedBy="listeFormation")
     */
    private $inscription;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Duree", mappedBy="dureeIntoSession")
     */
    private $compositionModule;

    public function __construct()
    {
        $this->inscription = new ArrayCollection();
        $this->compositionModule = new ArrayCollection();
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

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getPlaceTotale(): ?int
    {
        return $this->placeTotale;
    }

    public function setPlaceTotale(int $placeTotale): self
    {
        $this->placeTotale = $placeTotale;

        return $this;
    }

    /**
     * @return Collection|Stagiaire[]
     */
    public function getInscription(): Collection
    {
        return $this->inscription;
    }

    public function addInscription(Stagiaire $inscription): self
    {
        if (!$this->inscription->contains($inscription)) {
            $this->inscription[] = $inscription;
        }

        return $this;
    }

    public function removeInscription(Stagiaire $inscription): self
    {
        if ($this->inscription->contains($inscription)) {
            $this->inscription->removeElement($inscription);
        }

        return $this;
    }

    /**
     * @return Collection|Duree[]
     */
    public function getCompositionModule(): Collection
    {
        return $this->compositionModule;
    }

    public function addCompositionModule(Duree $compositionModule): self
    {
        if (!$this->compositionModule->contains($compositionModule)) {
            $this->compositionModule[] = $compositionModule;
            $compositionModule->setDureeIntoSession($this);
        }

        return $this;
    }

    public function removeCompositionModule(Duree $compositionModule): self
    {
        if ($this->compositionModule->contains($compositionModule)) {
            $this->compositionModule->removeElement($compositionModule);
            // set the owning side to null (unless already changed)
            if ($compositionModule->getDureeIntoSession() === $this) {
                $compositionModule->setDureeIntoSession(null);
            }
        }

        return $this;
    }




}
