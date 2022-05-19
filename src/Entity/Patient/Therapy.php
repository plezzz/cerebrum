<?php

namespace App\Entity\Patient;

use App\Repository\Patient\TherapyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TherapyRepository::class)
 */
class Therapy
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $drug;

    /**
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $unit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $morning;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lunch;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $evening;

    /**
     * @ORM\ManyToMany(targetEntity=TemperatureList::class, mappedBy="therapies")
     */
    private $temperatureLists;

    public function __construct()
    {
        $this->temperatureLists = new ArrayCollection();
    }

//    /**
//     * @ORM\ManyToOne(targetEntity=TemperatureList::class, inversedBy="therapies")
//     * @ORM\JoinColumn(nullable=false)
//     */
 //   private $temperatureList;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDrug(): ?string
    {
        return $this->drug;
    }

    public function setDrug(string $drug): self
    {
        $this->drug = $drug;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getMorning(): ?string
    {
        return $this->morning;
    }

    public function setMorning(string $morning): self
    {
        $this->morning = $morning;

        return $this;
    }

    public function getLunch(): ?string
    {
        return $this->lunch;
    }

    public function setLunch(string $lunch): self
    {
        $this->lunch = $lunch;

        return $this;
    }

    public function getEvening(): ?string
    {
        return $this->evening;
    }

    public function setEvening(string $evening): self
    {
        $this->evening = $evening;

        return $this;
    }

//    public function addTemperatureList(TemperatureList $temperatureList): void
//    {
//        if (!$this->temperatureLists->contains($temperatureList)) {
//            $this->temperatureLists->add($temperatureList);
//        }
//    }

//public function getTemperatureList(): ?TemperatureList
//{
//    return $this->temperatureList;
//}
//
//public function setTemperatureList(?TemperatureList $temperatureList): self
//{
//    $this->temperatureList = $temperatureList;
//
//    return $this;
//}

/**
 * @return Collection<int, TemperatureList>
 */
public function getTemperatureLists(): Collection
{
    return $this->temperatureLists;
}

public function addTemperatureList(TemperatureList $temperatureList): self
{
    if (!$this->temperatureLists->contains($temperatureList)) {
        $this->temperatureLists[] = $temperatureList;
        $temperatureList->addTherapy($this);
    }

    return $this;
}

public function removeTemperatureList(TemperatureList $temperatureList): self
{
    if ($this->temperatureLists->removeElement($temperatureList)) {
        $temperatureList->removeTherapy($this);
    }

    return $this;
}
}
