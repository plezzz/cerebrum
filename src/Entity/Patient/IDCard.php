<?php

namespace App\Entity\Patient;

use App\Entity\User;
use App\Repository\Patient\IDCardRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IDCardRepository::class)
 */
class IDCard
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $IDNumber;

    /**
     * @ORM\Column(type="datetime")
     */
    private $validity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $placeOfResidenceByID;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $placeOfResidenceByCurrentLocation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $publishedBy;

    /**
     * @ORM\OneToOne(targetEntity=Patient::class, mappedBy="IDCard", cascade={"persist", "remove"})
     */
    private $patient;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $editedBy;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIDNumber(): ?int
    {
        return $this->IDNumber;
    }

    public function setIDNumber(int $IDNumber): self
    {
        $this->IDNumber = $IDNumber;

        return $this;
    }

    public function getValidity(): ?DateTimeInterface
    {
        return $this->validity;
    }

    public function setValidity(DateTimeInterface $validity): self
    {
        $this->validity = $validity;

        return $this;
    }

    public function getPlaceOfResidenceByID(): ?string
    {
        return $this->placeOfResidenceByID;
    }

    public function setPlaceOfResidenceByID(string $placeOfResidenceByID): self
    {
        $this->placeOfResidenceByID = $placeOfResidenceByID;

        return $this;
    }

    public function getPlaceOfResidenceByCurrentLocation(): ?string
    {
        return $this->placeOfResidenceByCurrentLocation;
    }

    public function setPlaceOfResidenceByCurrentLocation(string $placeOfResidenceByCurrentLocation): self
    {
        $this->placeOfResidenceByCurrentLocation = $placeOfResidenceByCurrentLocation;

        return $this;
    }

    public function getPublishedBy(): ?string
    {
        return $this->publishedBy;
    }

    public function setPublishedBy(string $publishedBy): self
    {
        $this->publishedBy = $publishedBy;

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
            $this->patient->setIDCard(null);
        }

        // set the owning side of the relation if necessary
        if ($patient !== null && $patient->getIDCard() !== $this) {
            $patient->setIDCard($this);
        }

        $this->patient = $patient;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getEditedBy(): ?User
    {
        return $this->editedBy;
    }

    public function setEditedBy(User $editedBy): self
    {
        $this->editedBy = $editedBy;

        return $this;
    }
}
