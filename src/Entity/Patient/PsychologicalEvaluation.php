<?php

namespace App\Entity\Patient;

use App\Entity\User;
use App\Repository\Patient\PsychologicalEvaluationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PsychologicalEvaluationRepository::class)
 */
class PsychologicalEvaluation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $familyHistory;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $personalHistory;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $psychologicalProfile;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $therapeuticPlan;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="psychologicalEvaluations")
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $editedBy;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $editedAt;

    /**
     * @ORM\OneToOne(targetEntity=Patient::class, inversedBy="psychologicalEvaluation", cascade={"persist", "remove"})
     */
    private $patient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFamilyHistory(): ?string
    {
        return $this->familyHistory;
    }

    public function setFamilyHistory(?string $familyHistory): self
    {
        $this->familyHistory = $familyHistory;

        return $this;
    }

    public function getPersonalHistory(): ?string
    {
        return $this->personalHistory;
    }

    public function setPersonalHistory(?string $personalHistory): self
    {
        $this->personalHistory = $personalHistory;

        return $this;
    }

    public function getPsychologicalProfile(): ?string
    {
        return $this->psychologicalProfile;
    }

    public function setPsychologicalProfile(?string $psychologicalProfile): self
    {
        $this->psychologicalProfile = $psychologicalProfile;

        return $this;
    }

    public function getTherapeuticPlan(): ?string
    {
        return $this->therapeuticPlan;
    }

    public function setTherapeuticPlan(?string $therapeuticPlan): self
    {
        $this->therapeuticPlan = $therapeuticPlan;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

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

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }
}
