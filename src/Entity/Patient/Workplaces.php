<?php

namespace App\Entity\Patient;

use App\Entity\User;
use App\Repository\Patient\WorkplacesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorkplacesRepository::class)
 */
class Workplaces
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isWorking;

    /**
     * @ORM\ManyToMany(targetEntity=Workplace::class, inversedBy="workplaces",cascade={"persist"}, fetch="EAGER")
     */
    private $workplace;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
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
     * @ORM\OneToOne(targetEntity=Patient::class, inversedBy="workplaces", cascade={"persist", "remove"})
     */
    private $patient;

    public function __construct()
    {
        $this->workplace = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsWorking(): ?bool
    {
        return $this->isWorking;
    }

    public function setIsWorking(?bool $isWorking): self
    {
        $this->isWorking = $isWorking;

        return $this;
    }

    /**
     * @return Collection<int, Workplace>
     */
    public function getWorkplace(): Collection
    {
        return $this->workplace;
    }

    public function addWorkplace(Workplace $workplace): self
    {
        if (!$this->workplace->contains($workplace)) {
            $this->workplace[] = $workplace;
        }

        return $this;
    }

    public function removeWorkplace(Workplace $workplace): self
    {
        $this->workplace->removeElement($workplace);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getEditedAt()
    {
        return $this->editedAt;
    }

    /**
     * @param mixed $editedAt
     */
    public function setEditedAt($editedAt): void
    {
        $this->editedAt = $editedAt;
    }

    /**
     * @return mixed
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param mixed $createdBy
     */
    public function setCreatedBy($createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return mixed
     */
    public function getEditedBy()
    {
        return $this->editedBy;
    }

    /**
     * @param mixed $editedBy
     */
    public function setEditedBy($editedBy): void
    {
        $this->editedBy = $editedBy;
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
