<?php

namespace App\Entity\Patient;

use App\Entity\User;
use App\Repository\Patient\PsychiatricEvaluationRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PsychiatricEvaluationRepository::class)
 */
class PsychiatricEvaluation
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
    private $diagnostic;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $MKB;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $medicalHistory;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $concomitantDiseases;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $psychiatricEvaluation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $observationPeriodFrom;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $observationPeriodTo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $expertOpinion;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
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

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $createdBy;

    /**
     * @ORM\ManyToMany(targetEntity=Patient::class, inversedBy="psychiatricEvaluations")
     */
    private $patient;

    public function __construct()
    {
        $this->createdBy = new ArrayCollection();
        $this->patient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiagnostic(): ?string
    {
        return $this->diagnostic;
    }

    public function setDiagnostic(string $diagnostic): self
    {
        $this->diagnostic = $diagnostic;

        return $this;
    }

    public function getMKB(): ?string
    {
        return $this->MKB;
    }

    public function setMKB(string $MKB): self
    {
        $this->MKB = $MKB;

        return $this;
    }

    public function getMedicalHistory(): ?string
    {
        return $this->medicalHistory;
    }

    public function setMedicalHistory(string $medicalHistory): self
    {
        $this->medicalHistory = $medicalHistory;

        return $this;
    }

    public function getConcomitantDiseases(): ?string
    {
        return $this->concomitantDiseases;
    }

    public function setConcomitantDiseases(string $concomitantDiseases): self
    {
        $this->concomitantDiseases = $concomitantDiseases;

        return $this;
    }

    public function getPsychiatricEvaluation(): ?string
    {
        return $this->psychiatricEvaluation;
    }

    public function setPsychiatricEvaluation(string $psychiatricEvaluation): self
    {
        $this->psychiatricEvaluation = $psychiatricEvaluation;

        return $this;
    }

    public function getObservationPeriodFrom(): ?DateTimeInterface
    {
        return $this->observationPeriodFrom;
    }

    public function setObservationPeriodFrom(DateTimeInterface $observationPeriodFrom): self
    {
        $this->observationPeriodFrom = $observationPeriodFrom;

        return $this;
    }

    public function getObservationPeriodTo(): ?DateTimeInterface
    {
        return $this->observationPeriodTo;
    }

    public function setObservationPeriodTo(DateTimeInterface $observationPeriodTo): self
    {
        $this->observationPeriodTo = $observationPeriodTo;

        return $this;
    }

    public function getExpertOpinion(): ?string
    {
        return $this->expertOpinion;
    }

    public function setExpertOpinion(string $expertOpinion): self
    {
        $this->expertOpinion = $expertOpinion;

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

    public function addCreatedBy(User $createdBy): self
    {
        if (!$this->createdBy->contains($createdBy)) {
            $this->createdBy[] = $createdBy;
            $createdBy->setPsychiatricEvaluation($this);
        }

        return $this;
    }

    public function removeCreatedBy(User $createdBy): self
    {
        if ($this->createdBy->removeElement($createdBy)) {
            // set the owning side to null (unless already changed)
            if ($createdBy->getPsychiatricEvaluation() === $this) {
                $createdBy->setPsychiatricEvaluation(null);
            }
        }

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

    /**
     * @return Collection
     */
    public function getPatient(): Collection
    {
        return $this->patient;
    }

    public function addPatient(Patient $patient): self
    {
        if (!$this->patient->contains($patient)) {
            $this->patient[] = $patient;
        }

        return $this;
    }

    public function removePatient(Patient $patient): self
    {
        $this->patient->removeElement($patient);

        return $this;
    }

}
