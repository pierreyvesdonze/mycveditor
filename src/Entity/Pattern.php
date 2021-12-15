<?php

namespace App\Entity;

use App\Repository\PatternRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PatternRepository::class)
 */
class Pattern
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=CV::class, mappedBy="pattern", orphanRemoval=true)
     */
    private $cv;

    public function __construct()
    {
        $this->cv = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|CV[]
     */
    public function getCv(): Collection
    {
        return $this->cv;
    }

    public function addCv(CV $cv): self
    {
        if (!$this->cv->contains($cv)) {
            $this->cv[] = $cv;
            $cv->setPattern($this);
        }

        return $this;
    }

    public function removeCv(CV $cv): self
    {
        if ($this->cv->removeElement($cv)) {
            // set the owning side to null (unless already changed)
            if ($cv->getPattern() === $this) {
                $cv->setPattern(null);
            }
        }

        return $this;
    }
}
