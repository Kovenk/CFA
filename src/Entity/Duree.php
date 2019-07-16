<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DureeRepository")
 */
class Duree
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbJour;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Session", inversedBy="compositionModule")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dureeIntoSession;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Module", inversedBy="compositionSession")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dureeIntoModule;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbJour(): ?int
    {
        return $this->nbJour;
    }

    public function setNbJour(int $nbJour): self
    {
        $this->nbJour = $nbJour;

        return $this;
    }

    public function getDureeIntoSession(): ?Session
    {
        return $this->dureeIntoSession;
    }

    public function setDureeIntoSession(?Session $dureeIntoSession): self
    {
        $this->dureeIntoSession = $dureeIntoSession;

        return $this;
    }

    public function getDureeIntoModule(): ?Module
    {
        return $this->dureeIntoModule;
    }

    public function setDureeIntoModule(?Module $dureeIntoModule): self
    {
        $this->dureeIntoModule = $dureeIntoModule;

        return $this;
    }


}
