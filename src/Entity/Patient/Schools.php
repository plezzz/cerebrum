<?php

namespace App\Entity\Patient;

use App\Entity\User;
use App\Repository\Patient\SchoolsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SchoolsRepository::class)
 */
class Schools
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=School::class, inversedBy="schools",cascade={"persist"}, fetch="EAGER")
     */
    private $school;

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
     * @ORM\OneToOne(targetEntity=Patient::class, inversedBy="schools", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    public function __construct()
    {
        $this->school = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, School>
     */
    public function getSchool(): Collection
    {
        return $this->school;
    }

    public function addSchool(School $school): self
    {
        if (!$this->school->contains($school)) {
            $this->school[] = $school;
        }

        return $this;
    }

    public function removeSchool(School $school): self
    {
        $this->school->removeElement($school);

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

}
