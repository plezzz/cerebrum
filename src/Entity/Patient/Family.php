<?php

namespace App\Entity\Patient;

use App\Entity\User;
use App\Repository\Patient\FamilyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FamilyRepository::class)
 */
class Family
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
    private $maritalStatus;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $haveKids;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $amountOfBoys;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $amountOfGirls;

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
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $editedAt;

    /**
     * @ORM\OneToOne(targetEntity=Patient::class, inversedBy="family", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getHaveKids(): ?bool
    {
        return $this->haveKids;
    }

    public function setHaveKids(?bool $haveKids): self
    {
        $this->haveKids = $haveKids;

        return $this;
    }

    public function getAmountOfBoys(): ?int
    {
        return $this->amountOfBoys;
    }

    public function setAmountOfBoys(?int $amountOfBoys): self
    {
        $this->amountOfBoys = $amountOfBoys;

        return $this;
    }

    public function getAmountOfGirls(): ?int
    {
        return $this->amountOfGirls;
    }

    public function setAmountOfGirls(?int $amountOfGirls): self
    {
        $this->amountOfGirls = $amountOfGirls;

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

    public function geteditedBy(): ?User
    {
        return $this->editedBy;
    }

    public function seteditedBy(?User $editedBy): self
    {
        $this->editedBy = $editedBy;

        return $this;
    }

    public function getcreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setcreatedAt(\DateTimeImmutable $createdAt): self
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

    public function setPatient(Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }
}
