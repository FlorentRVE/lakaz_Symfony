<?php

namespace App\Entity;

use App\Repository\MacrosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MacrosRepository::class)]
class Macros
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $calorie = null;

    #[ORM\Column]
    private ?int $proteine = null;

    #[ORM\Column]
    private ?int $glucide = null;

    #[ORM\Column]
    private ?int $lipide = null;

    #[ORM\OneToMany(mappedBy: 'macros', cascade: ['persist'], targetEntity: Recette::class)]
    private Collection $recettes;

    public function __construct()
    {
        $this->recettes = new ArrayCollection();
    }

    // public function __toString() {

    //     return 'Calorie: ' . $this->calorie . ', Proteine: ' . $this->proteine . ', Glucide: ' . $this->glucide . ', Lipide: ' . $this->lipide;
    // }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCalorie(): ?int
    {
        return $this->calorie;
    }

    public function setCalorie(int $calorie): static
    {
        $this->calorie = $calorie;

        return $this;
    }

    public function getProteine(): ?int
    {
        return $this->proteine;
    }

    public function setProteine(int $proteine): static
    {
        $this->proteine = $proteine;

        return $this;
    }

    public function getGlucide(): ?int
    {
        return $this->glucide;
    }

    public function setGlucide(int $glucide): static
    {
        $this->glucide = $glucide;

        return $this;
    }

    public function getLipide(): ?int
    {
        return $this->lipide;
    }

    public function setLipide(int $lipide): static
    {
        $this->lipide = $lipide;

        return $this;
    }

    /**
     * @return Collection<int, Recette>
     */
    public function getRecettes(): Collection
    {
        return $this->recettes;
    }

    public function addRecette(Recette $recette): static
    {
        if (!$this->recettes->contains($recette)) {
            $this->recettes->add($recette);
            $recette->setMacros($this);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): static
    {
        if ($this->recettes->removeElement($recette)) {
            // set the owning side to null (unless already changed)
            if ($recette->getMacros() === $this) {
                $recette->setMacros(null);
            }
        }

        return $this;
    }


}
