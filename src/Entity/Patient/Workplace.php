<?php

namespace App\Entity\Patient;

use App\Entity\Country;
use App\Entity\User;
use App\Repository\Patient\WorkplaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorkplaceRepository::class)
 */
class Workplace
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
    private $position;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $employer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $workFrom;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $workTo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isWorkHere;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $moreInformation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $responsibilities;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $sector;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $department;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;

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
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

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
     * @ORM\ManyToMany(targetEntity=Workplaces::class, mappedBy="workplace")
     */
    private $workplaces;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class)
     */
    private $country;

    public function __construct()
    {
        $this->workplaces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getEmployer(): ?string
    {
        return $this->employer;
    }

    public function setEmployer(string $employer): self
    {
        $this->employer = $employer;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }


    public function getWorkFrom(): ?\DateTimeImmutable
    {
        return $this->workFrom;
    }

    public function setWorkFrom(?\DateTimeImmutable $workFrom): self
    {
        $this->workFrom = $workFrom;

        return $this;
    }

    public function getWorkTo(): ?\DateTimeImmutable
    {
        return $this->workTo;
    }

    public function setWorkTo(?\DateTimeImmutable $workTo): self
    {
        $this->workTo = $workTo;

        return $this;
    }

    public function getIsWorkHere(): ?bool
    {
        return $this->isWorkHere;
    }

    public function setIsWorkHere(?bool $isWorkHere): self
    {
        $this->isWorkHere = $isWorkHere;

        return $this;
    }

    public function getResponsibilities(): ?string
    {
        return $this->responsibilities;
    }

    public function setResponsibilities(?string $responsibilities): self
    {
        $this->responsibilities = $responsibilities;

        return $this;
    }

    public function getSector(): ?string
    {
        return $this->sector;
    }

    public function setSector(?string $sector): self
    {
        $this->sector = $sector;

        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(string $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(?string $postcode): self
    {
        $this->postcode = $postcode;

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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

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

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

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

    public function getEditedBy(): ?User
    {
        return $this->editedBy;
    }

    public function setEditedBy(?User $editedBy): self
    {
        $this->editedBy = $editedBy;

        return $this;
    }

    /**
     * @return Collection<int, Workplaces>
     */
    public function getWorkplaces(): Collection
    {
        return $this->workplaces;
    }

    public function addWorkplace(Workplaces $workplace): self
    {
        if (!$this->workplaces->contains($workplace)) {
            $this->workplaces[] = $workplace;
            $workplace->addWorkplace($this);
        }

        return $this;
    }

    public function removeWorkplace(Workplaces $workplace): self
    {
        if ($this->workplaces->removeElement($workplace)) {
            $workplace->removeWorkplace($this);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMoreInformation()
    {
        return $this->moreInformation;
    }

    /**
     * @param mixed $moreInformation
     */
    public function setMoreInformation($moreInformation): void
    {
        $this->moreInformation = $moreInformation;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

}
