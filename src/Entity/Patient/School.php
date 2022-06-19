<?php

namespace App\Entity\Patient;

use App\Entity\Country;
use App\Entity\User;
use App\Repository\Patient\SchoolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SchoolRepository::class)
 */
class School
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
    private $degree;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $schoolName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @ORM\Column(type="boolean")
     */
    private $moreInformation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $postcode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $learningFrom;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $learningTo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isLearningHere;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $editedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $editedBy;

    /**
     * @ORM\ManyToMany(targetEntity=Schools::class, mappedBy="school")
     */
    private $schools;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;

    public function __construct()
    {
        $this->schools = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDegree(): ?string
    {
        return $this->degree;
    }

    public function setDegree(string $degree): self
    {
        $this->degree = $degree;

        return $this;
    }

    public function getSchoolName(): ?string
    {
        return $this->schoolName;
    }

    public function setSchoolName(string $schoolName): self
    {
        $this->schoolName = $schoolName;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?country
    {
        return $this->country;
    }

    public function setCountry(?country $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getMoreInformation(): ?bool
    {
        return $this->moreInformation;
    }

    public function setMoreInformation(bool $moreInformation): self
    {
        $this->moreInformation = $moreInformation;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;

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

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getLearningFrom(): ?\DateTimeImmutable
    {
        return $this->learningFrom;
    }

    public function setLearningFrom(\DateTimeImmutable $learningFrom): self
    {
        $this->learningFrom = $learningFrom;

        return $this;
    }

    public function getLearningTo(): ?\DateTimeImmutable
    {
        return $this->learningTo;
    }

    public function setLearningTo(?\DateTimeImmutable $learningTo): self
    {
        $this->learningTo = $learningTo;

        return $this;
    }

    public function getIsLearningHere(): ?bool
    {
        return $this->isLearningHere;
    }

    public function setIsLearningHere(?bool $isLearningHere): self
    {
        $this->isLearningHere = $isLearningHere;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    /**
     * @return Collection<int, Schools>
     */
    public function getSchools(): Collection
    {
        return $this->schools;
    }

    public function addSchool(Schools $school): self
    {
        if (!$this->schools->contains($school)) {
            $this->schools[] = $school;
            $school->addSchool($this);
        }

        return $this;
    }

    public function removeSchool(Schools $school): self
    {
        if ($this->schools->removeElement($school)) {
            $school->removeSchool($this);
        }

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

}
