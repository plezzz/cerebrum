<?php

namespace App\Entity;

use App\Entity\Patient\Patient;
use App\Entity\Patient\PsychiatricEvaluationNote;
use App\Entity\Patient\SocialEvaluation;
use App\Entity\Patient\SocialEvaluationNote;
use App\Repository\UserRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"},message="Този имейл вече е използван!")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @Assert\Email(
     *     message = "'{{ value }}' не е валиден имейл.")
     * @Assert\NotBlank(message = "Полето не може да бъде празно")
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private ?string $email;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Role", inversedBy="users")
     * @ORM\JoinTable(name="user_role",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     *      )
     */
    private $roles;

    /**
     * @Assert\NotBlank(message = "Полето не може да бъде празно")
     * @Assert\Regex("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{10,}$/", message="Паролата трябва да бъде минимум 10 символа на латиница, да съдържа поне една голяма и малка буква, число и специален знак.")
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @Assert\NotBlank(message = "Полето не може да бъде празно")
     * @ORM\Column(type="integer")
     */
    private ?int $mobilePhone;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $editedAt;

    /**
     * @Assert\NotBlank(message = "Полето не може да бъде празно")
     * @ORM\Column(type="string", length=255)
     */
    private ?string $firstName;

    /**
     * @Assert\NotBlank(message = "Полето не може да бъде празно")
     * @ORM\Column(type="string", length=255)
     */
    private ?string $lastName;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isActive;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isDeleted;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $editedBy;

    /**
     * @ORM\OneToMany(targetEntity=Patient::class, mappedBy="createdBy")
     */
    private $createdPatients;

    /**
     * @ORM\OneToMany(targetEntity=Patient::class, mappedBy="editedBy")
     */
    private $editedPatients;

    /**
     * @ORM\OneToMany(targetEntity=FileUpload::class, mappedBy="createdBy")
     */
    private $fileUploads;

    /**
     * @ORM\OneToMany(targetEntity=PsychiatricEvaluationNote::class, mappedBy="createdBy")
     */
    private $psychiatricEvaluationNotes;


    /**
     * @ORM\OneToMany(targetEntity=PsychiatricEvaluationNote::class, mappedBy="editedBy")
     */
    private $psychiatricEvaluationNotesEdits;

    /**
     * @ORM\OneToMany(targetEntity=SocialEvaluation::class, mappedBy="createdBy")
     */
    private $socialEvaluations;

    /**
     * @ORM\OneToMany(targetEntity=SocialEvaluationNote::class, mappedBy="createdBy")
     */
    private $socialEvaluationNotes;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->createdPatients = new ArrayCollection();
        $this->editedPatients = new ArrayCollection();
        $this->fileUploads = new ArrayCollection();
        $this->psychiatricEvaluationNotes = new ArrayCollection();
        $this->psychiatricEvaluationNotesEdits = new ArrayCollection();
        $this->socialEvaluations = new ArrayCollection();
        $this->socialEvaluationNotes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }


    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getMobilePhone(): ?int
    {
        return $this->mobilePhone;
    }

    public function setMobilePhone(int $mobilePhone): self
    {
        $this->mobilePhone = $mobilePhone;

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

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }


    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return array (Role|string)[] The user roles
     */
    public function getRoles()
    {
        $stringRoles = [];
        foreach ($this->roles as $role) {
            /** @var Role $role */
            $stringRoles[] = $role->getName();
        }
        return $stringRoles;
    }

    /**
     * @param Role $role
     *
     * @return User
     */
    public function addRole(Role $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    public function removeRole(Role $role)
    {
        $this->roles->removeElement($role);

        return $this;
    }

    public function getCreatedBy(): ?self
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?self $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getEditedBy(): ?self
    {
        return $this->editedBy;
    }

    public function setEditedBy(?self $editedBy): self
    {
        $this->editedBy = $editedBy;

        return $this;
    }

    /**
     * @return Collection|Patient[]
     */
    public function getCreatedPatients(): Collection
    {
        return $this->createdPatients;
    }

    public function addCreatedPatient(Patient $createdPatient): self
    {
        if (!$this->createdPatients->contains($createdPatient)) {
            $this->createdPatients[] = $createdPatient;
            $createdPatient->setCreatedBy($this);
        }

        return $this;
    }

    public function removeCreatedPatient(Patient $createdPatient): self
    {
        if ($this->createdPatients->removeElement($createdPatient)) {
            // set the owning side to null (unless already changed)
            if ($createdPatient->getCreatedBy() === $this) {
                $createdPatient->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Patient[]
     */
    public function getEditedPatients(): Collection
    {
        return $this->editedPatients;
    }

    public function addEditedPatient(Patient $editedPatient): self
    {
        if (!$this->editedPatients->contains($editedPatient)) {
            $this->editedPatients[] = $editedPatient;
            $editedPatient->setEditedBy($this);
        }

        return $this;
    }

    public function removeEditedPatient(Patient $editedPatient): self
    {
        if ($this->editedPatients->removeElement($editedPatient)) {
            // set the owning side to null (unless already changed)
            if ($editedPatient->getEditedBy() === $this) {
                $editedPatient->setEditedBy(null);
            }
        }

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
            $fileUpload->setCreatedBy($this);
        }

        return $this;
    }

    public function removeFileUpload(FileUpload $fileUpload): self
    {
        if ($this->fileUploads->removeElement($fileUpload)) {
            // set the owning side to null (unless already changed)
            if ($fileUpload->getCreatedBy() === $this) {
                $fileUpload->setCreatedBy(null);
            }
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
            $psychiatricEvaluationNote->setCreatedBy($this);
        }

        return $this;
    }

    public function removePsychiatricEvaluationNote(PsychiatricEvaluationNote $psychiatricEvaluationNote): self
    {
        if ($this->psychiatricEvaluationNotes->removeElement($psychiatricEvaluationNote)) {
            // set the owning side to null (unless already changed)
            if ($psychiatricEvaluationNote->getCreatedBy() === $this) {
                $psychiatricEvaluationNote->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getPsychiatricEvaluationNotesEdits(): ArrayCollection
    {
        return $this->psychiatricEvaluationNotesEdits;
    }

    /**
     * @param ArrayCollection $psychiatricEvaluationNotesEdits
     */
    public function setPsychiatricEvaluationNotesEdits(ArrayCollection $psychiatricEvaluationNotesEdits): void
    {
        $this->psychiatricEvaluationNotesEdits = $psychiatricEvaluationNotesEdits;
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
            $socialEvaluation->setCreatedBy($this);
        }

        return $this;
    }

    public function removeSocialEvaluation(SocialEvaluation $socialEvaluation): self
    {
        if ($this->socialEvaluations->removeElement($socialEvaluation)) {
            // set the owning side to null (unless already changed)
            if ($socialEvaluation->getCreatedBy() === $this) {
                $socialEvaluation->setCreatedBy(null);
            }
        }

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
            $socialEvaluationNote->setCreatedBy($this);
        }

        return $this;
    }

    public function removeSocialEvaluationNote(SocialEvaluationNote $socialEvaluationNote): self
    {
        if ($this->socialEvaluationNotes->removeElement($socialEvaluationNote)) {
            // set the owning side to null (unless already changed)
            if ($socialEvaluationNote->getCreatedBy() === $this) {
                $socialEvaluationNote->setCreatedBy(null);
            }
        }

        return $this;
    }

}
