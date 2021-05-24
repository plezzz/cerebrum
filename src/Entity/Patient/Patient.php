<?php

namespace App\Entity\Patient;



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
     * @ORM\Column(type="date")
     */
    private $dateOfBirth;


    public function __construct()
    {
        $this->Contacts = new ArrayCollection();
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

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }
}
