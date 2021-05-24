<?php

namespace App\Entity\Patient;

use App\Entity\User;
use App\Repository\Patient\DetailsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetailsRepository::class)
 */
class Details
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
    private $Sex;

    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\Column(type="float")
     */
    private $height;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hairColor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eyeColor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $maritalStatus;

    /**
     * @ORM\OneToOne(targetEntity=Patient::class, mappedBy="Details", cascade={"persist", "remove"})
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $editedBy;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $editedAt;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSex(): ?string
    {
        return $this->Sex;
    }

    public function setSex(string $Sex): self
    {
        $this->Sex = $Sex;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getHairColor(): ?string
    {
        return $this->hairColor;
    }

    public function setHairColor(string $hairColor): self
    {
        $this->hairColor = $hairColor;

        return $this;
    }

    public function getEyeColor(): ?string
    {
        return $this->eyeColor;
    }

    public function setEyeColor(string $eyeColor): self
    {
        $this->eyeColor = $eyeColor;

        return $this;
    }

    public function getMaritalStatus(): ?string
    {
        return $this->maritalStatus;
    }

    public function setMaritalStatus(string $maritalStatus): self
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        // unset the owning side of the relation if necessary
        if ($patient === null && $this->patient !== null) {
            $this->patient->setDetails(null);
        }

        // set the owning side of the relation if necessary
        if ($patient !== null && $patient->getDetails() !== $this) {
            $patient->setDetails($this);
        }

        $this->patient = $patient;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getEditedBy(): ?User
    {
        return $this->editedBy;
    }

    public function setEditedBy(?User $editedBy): self
    {
        $this->editedBy = $editedBy;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getEditedAt(): ?\DateTimeInterface
    {
        return $this->editedAt;
    }

    public function setEditedAt(\DateTimeInterface $editedAt): self
    {
        $this->editedAt = $editedAt;

        return $this;
    }
}
