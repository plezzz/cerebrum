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
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $editedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="createdPatients")
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="editedPatients")
     */
    private $editedBy;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isInHospital;

    /**
     * @Assert\NotBlank(message = "Полето не може да бъде празно")
     * @ORM\Column(type="date")
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mobilePhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=FileUpload::class, mappedBy="patient")
     */
    private $fileUploads;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profilePicture;

    /**
     * @ORM\ManyToMany(targetEntity=PsychiatricEvaluation::class, mappedBy="patient")
     */
    private $psychiatricEvaluations;

    /**
     * @ORM\ManyToMany(targetEntity=Report::class, mappedBy="patient")
     */
    private $reports;

    /**
     * @ORM\ManyToMany(targetEntity=SocialEvaluation::class, mappedBy="patient")
     */
    private $socialEvaluations;


    public function __construct()
    {
        $this->Contacts = new ArrayCollection();
        $this->fileUploads = new ArrayCollection();
        $this->psychiatricEvaluations = new ArrayCollection();
        $this->reports = new ArrayCollection();
        $this->socialEvaluations = new ArrayCollection();
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
     * @return Collection|PsychiatricEvaluation[]
     */
    public function getPsychiatricEvaluations(): Collection
    {
        return $this->psychiatricEvaluations;
    }

    public function addPsychiatricEvaluation(PsychiatricEvaluation $psychiatricEvaluation): self
    {
        if (!$this->psychiatricEvaluations->contains($psychiatricEvaluation)) {
            $this->psychiatricEvaluations[] = $psychiatricEvaluation;
            $psychiatricEvaluation->addPatient($this);
        }

        return $this;
    }

    public function removePsychiatricEvaluation(PsychiatricEvaluation $psychiatricEvaluation): self
    {
        if ($this->psychiatricEvaluations->removeElement($psychiatricEvaluation)) {
            $psychiatricEvaluation->removePatient($this);
        }

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
     * @return Collection<int, SocialEvaluation>
     */
    public function getSocialEvaluations(): Collection
    {
        return $this->socialEvaluations;
    }

    public function addSocialEvaluation(SocialEvaluation $socialEvaluation): self
    {
        if (!$this->socialEvaluations->contains($socialEvaluation)) {
            $this->socialEvaluations[] = $socialEvaluation;
            $socialEvaluation->addPatient($this);
        }

        return $this;
    }

    public function removeSocialEvaluation(SocialEvaluation $socialEvaluation): self
    {
        if ($this->socialEvaluations->removeElement($socialEvaluation)) {
            $socialEvaluation->removePatient($this);
        }

        return $this;
    }

}
