<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MaisonRepository")
 */
class Maison
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
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Etage", mappedBy="maison", orphanRemoval=true)
     */
    private $etages;

    public function __construct()
    {
        $this->etages = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Etage[]
     */
    public function getEtages(): Collection
    {
        return $this->etages;
    }

    public function addEtage(Etage $etage): self
    {
        if (!$this->etages->contains($etage)) {
            $this->etages[] = $etage;
            $etage->setMaison($this);
        }

        return $this;
    }

    public function removeEtage(Etage $etage): self
    {
        if ($this->etages->contains($etage)) {
            $this->etages->removeElement($etage);
            // set the owning side to null (unless already changed)
            if ($etage->getMaison() === $this) {
                $etage->setMaison(null);
            }
        }

        return $this;
    }
}
