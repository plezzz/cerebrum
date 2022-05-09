<?php

namespace App\Entity\Patient;


use App\Entity\FileUpload;
use App\Entity\User;
use App\Repository\PatientRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PatientRepository::class)
 * @UniqueEntity(
 *     fields={"EGN"},
 *     message="Вече съществува човек с това ЕГН."
 * )
 */
class Patient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @Assert\NotBlank(message = "Полето не може да бъде празно")
     *
     * @ORM\Column(type="string", length=255)
     */
    private ?string $firstName;

    /**
     * @Assert\NotBlank(message = "Полето не може да бъде празно")
     *
     * @ORM\Column(type="string", length=255)
     */
    private ?string $middleName;

    /**
     * @Assert\NotBlank(message = "Полето не може да бъде празно")
     *
     * @ORM\Column(type="string", length=255)
     */
    private ?string $lastName;

    /**
     * @Assert\NotBlank(message = "Полето не може да бъде празно")
     * @Assert\Regex("/^[0-9]{10}$/", message="Грешно ЕГН"),
     *
     * @ORM\Column(type="string", length=10)
     */
    private ?string $EGN;


    /**
     * @ORM\OneToOne(targetEntity=Details::class, inversedBy="patient", cascade={"persist", "remove"})
     */
    private ?Details $Details;

    /**
     * @ORM\OneToMany(targetEntity=Contacts::class, mappedBy="patient", orphanRemoval=true)
     */
    private Collection $Contacts;

    /**
     * @ORM\OneToOne(targetEntity=IDCard::class, inversedBy="patient", cascade={"persist", "remove"})
     */
    private ?IDCard $IDCard;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $editedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="createdPatients")
     */
    private ?User $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="editedPatients")
     */
    private ?User $editedBy;


    /**
     * @Assert\NotBlank(message = "Полето не може да бъде празно")
     * @ORM\Column(type="date")
     */
    private ?DateTimeInterface $dateOfBirth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $mobilePhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $email;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private ?string $patientID;

    /**
     * @ORM\OneToMany(targetEntity=FileUpload::class, mappedBy="patient")
     */
    private $fileUploads;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $profilePicture;


    /**
     * @ORM\ManyToMany(targetEntity=Report::class, mappedBy="patient")
     */
    private $reports;


    /**
     * @ORM\OneToMany(targetEntity=PsychiatricEvaluationNote::class, mappedBy="patient")
     */
    private $psychiatricEvaluationNotes;

    /**
     * @ORM\OneToOne(targetEntity=PsychiatricEvaluation::class, mappedBy="patient", cascade={"persist", "remove"})
     */
    private ?PsychiatricEvaluation $psychiatricEvaluation;

    /**
     * @ORM\OneToOne(targetEntity=SocialEvaluation::class, mappedBy="patient", cascade={"persist", "remove"})
     */
    private ?SocialEvaluation $socialEvaluation;

    /**
     * @ORM\OneToMany(targetEntity=SocialEvaluationNote::class, mappedBy="patient")
     */
    private $socialEvaluationNotes;

    /**
     * @ORM\OneToMany(targetEntity=PsychologicalEvaluationNote::class, mappedBy="patient")
     */
    private $psychologicalEvaluationNotes;

    /**
     * @ORM\OneToOne(targetEntity=PsychologicalEvaluation::class, mappedBy="patient", cascade={"persist", "remove"})
     */
    private $psychologicalEvaluation;

    /**
     * @ORM\OneToOne(targetEntity=Habits::class, mappedBy="patient", cascade={"persist", "remove"})
     */
    private $habits;


    public function __construct()
    {
        $this->Contacts = new ArrayCollection();
        $this->fileUploads = new ArrayCollection();
        $this->reports = new ArrayCollection();
        $this->psychiatricEvaluationNotes = new ArrayCollection();
        $this->socialEvaluationNotes = new ArrayCollection();
        $this->psychologicalEvaluationNotes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEGN(): ?string
    {
        return $this->EGN;
    }

    public function setEGN(string $EGN): self
    {
        $this->EGN = $EGN;

        return $this;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function setMiddleName(string $middleName): self
    {
        $this->middleName = $middleName;

        return $this;
    }

    public function getDetails(): ?Details
    {
        return $this->Details;
    }

    public function setDetails(?Details $Details): self
    {
        $this->Details = $Details;

        return $this;
    }

    /**
     * @return Collection|Contacts[]
     */
    public function getContacts(): Collection
    {
        return $this->Contacts;
    }

    public function addContact(Contacts $contact): self
    {
        if (!$this->Contacts->contains($contact)) {
            $this->Contacts[] = $contact;
            $contact->setPatient($this);
        }

        return $this;
    }

    public function removeContact(Contacts $contact): self
    {
        if ($this->Contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getPatient() === $this) {
                $contact->setPatient(null);
            }
        }

        return $this;
    }

    public function getIDCard(): ?IDCard
    {
        return $this->IDCard;
    }

    public function setIDCard(?IDCard $IDCard): self
    {
        $this->IDCard = $IDCard;

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

    public function getIsInHospital(): ?bool
    {
        return $this->isInHospital;
    }

    public function setIsInHospital(bool $isInHospital): self
    {
        $this->isInHospital = $isInHospital;

        return $this;
    }

    public function getDateOfBirth(): ?DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    public function setMobilePhone(?string $mobilePhone): self
    {
        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|FileUpload[]
     */
    public function getFileUploads(): Collection
    {
        return $this->fileUploads;
    }

    public function addFileUpload(FileUpload $fileUpload): self
    {
        if (!$this->fileUploads->contains($fileUpload)) {
            $this->fileUploads[] = $fileUpload;
            $fileUpload->setPatient($this);
        }

        return $this;
    }

    public function removeFileUpload(FileUpload $fileUpload): self
    {
        if ($this->fileUploads->removeElement($fileUpload)) {
            // set the owning side to null (unless already changed)
            if ($fileUpload->getPatient() === $this) {
                $fileUpload->setPatient(null);
            }
        }

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(string $profilePicture): self
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }


    /**
     * @return Collection|Report[]
     */
    public function getReports(): Collection
    {
        return $this->reports;
    }

    public function addReport(Report $report): self
    {
        if (!$this->reports->contains($report)) {
            $this->reports[] = $report;
            $report->addPatient($this);
        }

        return $this;
    }

    public function removeReport(Report $report): self
    {
        if ($this->reports->removeElement($report)) {
            $report->removePatient($this);
        }

        return $this;
    }


    /**
     * @return Collection<int, PsychiatricEvaluationNote>
     */
    public function getPsychiatricEvaluationNotes(): Collection
    {
        return $this->psychiatricEvaluationNotes;
    }

    public function addPsychiatricEvaluationNote(PsychiatricEvaluationNote $psychiatricEvaluationNote): self
    {
        if (!$this->psychiatricEvaluationNotes->contains($psychiatricEvaluationNote)) {
            $this->psychiatricEvaluationNotes[] = $psychiatricEvaluationNote;
            $psychiatricEvaluationNote->setPatient($this);
        }

        return $this;
    }

    public function removePsychiatricEvaluationNote(PsychiatricEvaluationNote $psychiatricEvaluationNote): self
    {
        if ($this->psychiatricEvaluationNotes->removeElement($psychiatricEvaluationNote)) {
            // set the owning side to null (unless already changed)
            if ($psychiatricEvaluationNote->getPatient() === $this) {
                $psychiatricEvaluationNote->setPatient(null);
            }
        }

        return $this;
    }

    public function getPsychiatricEvaluation(): ?PsychiatricEvaluation
    {
        return $this->psychiatricEvaluation;
    }

    public function setPsychiatricEvaluation(?PsychiatricEvaluation $psychiatricEvaluation): self
    {
        // unset the owning side of the relation if necessary
        if ($psychiatricEvaluation === null && $this->psychiatricEvaluation !== null) {
            $this->psychiatricEvaluation->setPatient(null);
        }

        // set the owning side of the relation if necessary
        if ($psychiatricEvaluation !== null && $psychiatricEvaluation->getPatient() !== $this) {
            $psychiatricEvaluation->setPatient($this);
        }

        $this->psychiatricEvaluation = $psychiatricEvaluation;

        return $this;
    }

    /**
     * @return Collection<int, SocialEvaluationNote>
     */
    public function getSocialEvaluationNotes(): Collection
    {
        return $this->socialEvaluationNotes;
    }

    public function addSocialEvaluationNote(SocialEvaluationNote $socialEvaluationNote): self
    {
        if (!$this->socialEvaluationNotes->contains($socialEvaluationNote)) {
            $this->socialEvaluationNotes[] = $socialEvaluationNote;
            $socialEvaluationNote->setPatient($this);
        }

        return $this;
    }

    public function removeSocialEvaluationNote(SocialEvaluationNote $socialEvaluationNote): self
    {
        if ($this->socialEvaluationNotes->removeElement($socialEvaluationNote)) {
            // set the owning side to null (unless already changed)
            if ($socialEvaluationNote->getPatient() === $this) {
                $socialEvaluationNote->setPatient(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSocialEvaluation()
    {
        return $this->socialEvaluation;
    }

    /**
     * @param mixed $socialEvaluation
     */
    public function setSocialEvaluation($socialEvaluation): void
    {
        $this->socialEvaluation = $socialEvaluation;
    }

    /**
     * @return string|null
     */
    public function getPatientID(): ?string
    {
        return $this->patientID;
    }

    /**
     * @param string|null $patientID
     */
    public function setPatientID(?string $patientID): void
    {
        $this->patientID = $patientID;
    }

    /**
     * @return Collection<int, PsychologicalEvaluationNote>
     */
    public function getPsychologicalEvaluationNotes(): Collection
    {
        return $this->psychologicalEvaluationNotes;
    }

    public function addPsychologicalEvaluationNote(PsychologicalEvaluationNote $psychologicalEvaluationNote): self
    {
        if (!$this->psychologicalEvaluationNotes->contains($psychologicalEvaluationNote)) {
            $this->psychologicalEvaluationNotes[] = $psychologicalEvaluationNote;
            $psychologicalEvaluationNote->setPatient($this);
        }

        return $this;
    }

    public function removePsychologicalEvaluationNote(PsychologicalEvaluationNote $psychologicalEvaluationNote): self
    {
        if ($this->psychologicalEvaluationNotes->removeElement($psychologicalEvaluationNote)) {
            // set the owning side to null (unless already changed)
            if ($psychologicalEvaluationNote->getPatient() === $this) {
                $psychologicalEvaluationNote->setPatient(null);
            }
        }

        return $this;
    }

    public function getPsychologicalEvaluation(): ?PsychologicalEvaluation
    {
        return $this->psychologicalEvaluation;
    }

    public function setPsychologicalEvaluation(?PsychologicalEvaluation $psychologicalEvaluation): self
    {
        // unset the owning side of the relation if necessary
        if ($psychologicalEvaluation === null && $this->psychologicalEvaluation !== null) {
            $this->psychologicalEvaluation->setPatient(null);
        }

        // set the owning side of the relation if necessary
        if ($psychologicalEvaluation !== null && $psychologicalEvaluation->getPatient() !== $this) {
            $psychologicalEvaluation->setPatient($this);
        }

        $this->psychologicalEvaluation = $psychologicalEvaluation;

        return $this;
    }

    public function getHabits(): ?Habits
    {
        return $this->habits;
    }

    public function setHabits(Habits $habits): self
    {
        // set the owning side of the relation if necessary
        if ($habits->getPatient() !== $this) {
            $habits->setPatient($this);
        }

        $this->habits = $habits;

        return $this;
    }

}
