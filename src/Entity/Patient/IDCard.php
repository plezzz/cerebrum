<?php

namespace App\Entity\Patient;

use App\Entity\User;
use App\Repository\Patient\IDCardRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=IDCardRepository::class)
 * @UniqueEntity(
 *     fields={"IDNumber"},
 *     message="Вече съществува човек с тази лична карта."
 * )
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
     * @Assert\NotBlank(message = "Полето не може да бъде празно")
     * @Assert\Regex("/^[0-9]{9,11}$/", message="Грешен номер")
     * @ORM\Column(type="string", length=10)
     */
    private $IDNumber;

    /**
     * @Assert\NotBlank(message = "Полето не може да бъде празно")
     * @ORM\Column(type="date")
     */
    private $validity;

    /**
     * @Assert\NotBlank(message = "Полето не може да бъде празно")
     * @ORM\Column(type="string", length=255)
     */
    private $placeOfResidenceByID;

    /**
     * @Assert\NotBlank(message = "Полето не може да бъде празно")
     * @ORM\Column(type="string", length=255)
     */
    private $placeOfResidenceByCurrentLocation;

    /**
     * @Assert\NotBlank(message = "Полето не може да бъде празно")
     * @ORM\Column(type="string", length=255)
     */
    private $publishedBy;

    /**
     * @ORM\OneToOne(targetEntity=Patient::class, mappedBy="IDCard", cascade={"persist", "remove"})
     */
    private ?Patient $patient;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBY;

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

    public function getCreatedBY(): ?User
    {
        return $this->createdBY;
    }

    public function setCreatedBY(?User $createdBY): self
    {
        $this->createdBY = $createdBY;

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

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getEditedAt(): ?DateTimeInterface
    {
        return $this->editedAt;
    }

    public function setEditedAt(DateTimeInterface $editedAt): self
    {
        $this->editedAt = $editedAt;

        return $this;
    }
}
