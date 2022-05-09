<?php

namespace App\Entity\Patient;

use App\Entity\User;
use App\Repository\Patient\HabitsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HabitsRepository::class)
 */
class Habits
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $smoking;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $amountOfCigarettesPerDay;

    /**
     * @ORM\Column(type="boolean")
     */
    private $alcohol;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $amountOfAlcoholPerDay;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $howOftenHeConsumesAlcohol;

    /**
     * @ORM\Column(type="boolean")
     */
    private $narcotics;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $howOftenHeUsesDrugs;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $whatTypeOfDrugUses;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $useInTheMomentNarcotics;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $editedAt;

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
     * @ORM\OneToOne(targetEntity=Patient::class, inversedBy="habits", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSmoking(): ?bool
    {
        return $this->smoking;
    }

    public function setSmoking(bool $smoking): self
    {
        $this->smoking = $smoking;

        return $this;
    }

    public function getAmountOfCigarettesPerDay(): ?int
    {
        return $this->amountOfCigarettesPerDay;
    }

    public function setAmountOfCigarettesPerDay(?int $amountOfCigarettesPerDay): self
    {
        $this->amountOfCigarettesPerDay = $amountOfCigarettesPerDay;

        return $this;
    }

    public function getAlcohol(): ?bool
    {
        return $this->alcohol;
    }

    public function setAlcohol(bool $alcohol): self
    {
        $this->alcohol = $alcohol;

        return $this;
    }

    public function getAmountOfAlcoholPerDay(): ?int
    {
        return $this->amountOfAlcoholPerDay;
    }

    public function setAmountOfAlcoholPerDay(?int $amountOfAlcoholPerDay): self
    {
        $this->amountOfAlcoholPerDay = $amountOfAlcoholPerDay;

        return $this;
    }

    public function getHowOftenHeConsumesAlcohol()
    {
        return $this->howOftenHeConsumesAlcohol;
    }

    public function setHowOftenHeConsumesAlcohol($howOftenHeConsumesAlcohol): self
    {
        $this->howOftenHeConsumesAlcohol = $howOftenHeConsumesAlcohol;

        return $this;
    }

    public function getNarcotics(): ?bool
    {
        return $this->narcotics;
    }

    public function setNarcotics(bool $narcotics): self
    {
        $this->narcotics = $narcotics;

        return $this;
    }

    public function getHowOftenHeUsesDrugs()
    {
        return $this->howOftenHeUsesDrugs;
    }

    public function setHowOftenHeUsesDrugs($howOftenHeUsesDrugs): self
    {
        $this->howOftenHeUsesDrugs = $howOftenHeUsesDrugs;

        return $this;
    }

    public function getWhatTypeOfDrugUses(): ?string
    {
        return $this->whatTypeOfDrugUses;
    }

    public function setWhatTypeOfDrugUses(?string $whatTypeOfDrugUses): self
    {
        $this->whatTypeOfDrugUses = $whatTypeOfDrugUses;

        return $this;
    }

    public function getUseInTheMomentNarcotics(): ?bool
    {
        return $this->useInTheMomentNarcotics;
    }

    public function setUseInTheMomentNarcotics(?bool $useInTheMomentNarcotics): self
    {
        $this->useInTheMomentNarcotics = $useInTheMomentNarcotics;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getEditedAt(): ?\DateTimeImmutable
    {
        return $this->editedAt;
    }

    public function setEditedAt(\DateTimeImmutable $editedAt): self
    {
        $this->editedAt = $editedAt;

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

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }
}
