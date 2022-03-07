<?php

namespace App\Entity\Patient;

use App\Entity\User;
use App\Repository\Patient\SocialEvaluationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $socialStatus;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $needs;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $assessment;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $recommendation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="socialEvaluationsEdit")
     */
    private $editedBy;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="socialEvaluations")
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $editedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Patient::class, inversedBy="socialEvaluations")
     */
    private $patient;

    public function __construct()
    {
        $this->patient = new ArrayCollection();
    }

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

    public function getNeeds(): ?string
    {
        return $this->needs;
    }

    public function setNeeds(?string $needs): self
    {
        $this->needs = $needs;

        return $this;
    }

    public function getAssessment(): ?string
    {
        return $this->assessment;
    }

    public function setAssessment(?string $assessment): self
    {
        $this->assessment = $assessment;

        return $this;
    }

    public function getRecommendation(): ?string
    {
        return $this->recommendation;
    }

    public function setRecommendation(?string $recommendation): self
    {
        $this->recommendation = $recommendation;

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

    public function getEditedBy(): ?User
    {
        return $this->editedBy;
    }

    public function setEditedBy(?User $editedBy): self
    {
        $this->editedBy = $editedBy;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $cretedBy): self
    {
        $this->createdBy = $cretedBy;

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

    /**
     * @return Collection<int, Patient>
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
