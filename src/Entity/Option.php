<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OptionRepository")
 * @ORM\Table(name="`option`")
 */
class Option
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
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Prprety", mappedBy="options")
     */
    private $propreties;

    public function __construct()
    {
        $this->propreties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Prprety[]
     */
    public function getPropreties(): Collection
    {
        return $this->propreties;
    }

    public function addProprety(Prprety $proprety): self
    {
        if (!$this->propreties->contains($proprety)) {
            $this->propreties[] = $proprety;
        }

        return $this;
    }

    public function removeProprety(Prprety $proprety): self
    {
        if ($this->propreties->contains($proprety)) {
            $this->propreties->removeElement($proprety);
        }

        return $this;
    }
}
