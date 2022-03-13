<?php

namespace App\Entity\Patient;

use App\Entity\User;
use App\Repository\Patient\SocialEvaluationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SocialEvaluationRepository::class)
 */
class SocialEvaluation
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
    private ?string $socialStatus;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $socialNeeds;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $socialAssessment;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $socialIntegration;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $note;

    /**
     * @ORM\OneToOne(targetEntity=Patient::class, inversedBy="socialEvaluation", cascade={"persist", "remove"})
     */
    private ?Patient $patient;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="socialEvaluations")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private ?User $editedBy;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private ?\DateTimeImmutable $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $editedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSocialStatus(): ?string
    {
        return $this->socialStatus;
    }

    public function setSocialStatus(?string $socialStatus): self
    {
        $this->socialStatus = $socialStatus;

        return $this;
    }

    public function getSocialNeeds(): ?string
    {
        return $this->socialNeeds;
    }

    public function setSocialNeeds(?string $socialNeeds): self
    {
        $this->socialNeeds = $socialNeeds;

        return $this;
    }

    public function getSocialAssessment(): ?string
    {
        return $this->socialAssessment;
    }

    public function setSocialAssessment(?string $socialAssessment): self
    {
        $this->socialAssessment = $socialAssessment;

        return $this;
    }

    public function getSocialIntegration(): ?string
    {
        return $this->socialIntegration;
    }

    public function setSocialIntegration(?string $socialIntegration): self
    {
        $this->socialIntegration = $socialIntegration;

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

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
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
}
