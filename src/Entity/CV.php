<?php

namespace App\Entity;

use App\Repository\CVRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CVRepository::class)
 */
class CV
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="cVs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="date")
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $PhoneNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresseStreet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresseNumberStreet;

    /**
     * @ORM\Column(type="integer")
     */
    private $adressePostalCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresseTown;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=Education::class, mappedBy="educations")
     */
    private $education;

    /**
     * @ORM\OneToMany(targetEntity=Skill::class, mappedBy="cV", orphanRemoval=true)
     */
    private $skills;

    /**
     * @ORM\OneToMany(targetEntity=Experience::class, mappedBy="cV")
     */
    private $Experience;

    /**
     * @ORM\OneToMany(targetEntity=Interest::class, mappedBy="cV", orphanRemoval=true)
     */
    private $interests;

    public function __construct()
    {
        $this->education = new ArrayCollection();
        $this->skills = new ArrayCollection();
        $this->interests = new ArrayCollection();
        $this->Experience = new ArrayCollection();
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->PhoneNumber;
    }

    public function setPhoneNumber(string $PhoneNumber): self
    {
        $this->PhoneNumber = $PhoneNumber;

        return $this;
    }

    public function getAdresseStreet(): ?string
    {
        return $this->adresseStreet;
    }

    public function setAdresseStreet(string $adresseStreet): self
    {
        $this->adresseStreet = $adresseStreet;

        return $this;
    }

    public function getAdresseNumberStreet(): ?string
    {
        return $this->adresseNumberStreet;
    }

    public function setAdresseNumberStreet(string $adresseNumberStreet): self
    {
        $this->adresseNumberStreet = $adresseNumberStreet;

        return $this;
    }

    public function getAdressePostalCode(): ?int
    {
        return $this->adressePostalCode;
    }

    public function setAdressePostalCode(int $adressePostalCode): self
    {
        $this->adressePostalCode = $adressePostalCode;

        return $this;
    }

    public function getAdresseTown(): ?string
    {
        return $this->adresseTown;
    }

    public function setAdresseTown(string $adresseTown): self
    {
        $this->adresseTown = $adresseTown;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|Education[]
     */
    public function getEducation(): Collection
    {
        return $this->education;
    }

    public function addEducation(Education $education): self
    {
        if (!$this->education->contains($education)) {
            $this->education[] = $education;
            $education->setEducations($this);
        }

        return $this;
    }

    public function removeEducation(Education $education): self
    {
        if ($this->education->removeElement($education)) {
            // set the owning side to null (unless already changed)
            if ($education->getEducations() === $this) {
                $education->setEducations(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Skill[]
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skill $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
            $skill->setCV($this);
        }

        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        if ($this->skills->removeElement($skill)) {
            // set the owning side to null (unless already changed)
            if ($skill->getCV() === $this) {
                $skill->setCV(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Interest[]
     */
    public function getInterests(): Collection
    {
        return $this->interests;
    }

    public function addInterest(Interest $interest): self
    {
        if (!$this->interests->contains($interest)) {
            $this->interests[] = $interest;
            $interest->setCV($this);
        }

        return $this;
    }

    public function removeInterest(Interest $interest): self
    {
        if ($this->interests->removeElement($interest)) {
            // set the owning side to null (unless already changed)
            if ($interest->getCV() === $this) {
                $interest->setCV(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Experience[]
     */
    public function getExperience(): Collection
    {
        return $this->Experience;
    }

    public function addExperience(Experience $experience): self
    {
        if (!$this->Experience->contains($experience)) {
            $this->Experience[] = $experience;
            $experience->setCV($this);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): self
    {
        if ($this->Experience->removeElement($experience)) {
            // set the owning side to null (unless already changed)
            if ($experience->getCV() === $this) {
                $experience->setCV(null);
            }
        }

        return $this;
    }
}
