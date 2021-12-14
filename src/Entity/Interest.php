<?php

namespace App\Entity;

use App\Repository\InterestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InterestRepository::class)
 */
class Interest
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity=CV::class, inversedBy="interests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cV;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

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
