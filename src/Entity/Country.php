<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CountryRepository::class)
 */
class Country
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $isoCode2;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $isoCode3;

    /**
     * @ORM\Column(type="text")
     */
    private $adressFormat;

    /**
     * @ORM\Column(type="boolean")
     */
    private $postcodeRequired;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIsoCode2(): ?string
    {
        return $this->isoCode2;
    }

    public function setIsoCode2(string $isoCode2): self
    {
        $this->isoCode2 = $isoCode2;

        return $this;
    }

    public function getIsoCode3(): ?string
    {
        return $this->isoCode3;
    }

    public function setIsoCode3(string $isoCode3): self
    {
        $this->isoCode3 = $isoCode3;

        return $this;
    }

    public function getAdressFormat(): ?string
    {
        return $this->adressFormat;
    }

    public function setAdressFormat(string $adressFormat): self
    {
        $this->adressFormat = $adressFormat;

        return $this;
    }

    public function getPostcodeRequired(): ?bool
    {
        return $this->postcodeRequired;
    }

    public function setPostcodeRequired(bool $postcodeRequired): self
    {
        $this->postcodeRequired = $postcodeRequired;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
