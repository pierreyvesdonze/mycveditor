<?php

namespace App\Entity;

use App\Repository\ExperienceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExperienceRepository::class)
 */
class Experience
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $startDate;

    /**
     * @ORM\Column(type="date")
     */
    private $endDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $town;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $companyName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=ExperienceLine::class, mappedBy="experience")
     */
    private $experienceLines;

    /**
     * @ORM\ManyToOne(targetEntity=CV::class, inversedBy="Experience")
     */
    private $cV;

    public function __construct()
    {
        $this->experienceLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(string $town): self
    {
        $this->town = $town;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|ExperienceLine[]
     */
    public function getExperienceLines(): Collection
    {
        return $this->experienceLines;
    }

    public function addExperienceLine(ExperienceLine $experienceLine): self
    {
        if (!$this->experienceLines->contains($experienceLine)) {
            $this->experienceLines[] = $experienceLine;
            $experienceLine->setExperience($this);
        }

        return $this;
    }

    public function removeExperienceLine(ExperienceLine $experienceLine): self
    {
        if ($this->experienceLines->removeElement($experienceLine)) {
            // set the owning side to null (unless already changed)
            if ($experienceLine->getExperience() === $this) {
                $experienceLine->setExperience(null);
            }
        }

        return $this;
    }

    public function getCV(): ?CV
    {
        return $this->cV;
    }

    public function setCV(?CV $cV): self
    {
        $this->cV = $cV;

        return $this;
    }
}
