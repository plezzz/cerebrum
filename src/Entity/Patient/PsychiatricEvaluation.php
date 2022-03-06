<?php

namespace App\Entity\Patient;

use App\Entity\User;
use App\Repository\Patient\PsychiatricEvaluationRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PsychiatricEvaluationRepository::class)
 */
class PsychiatricEvaluation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $editedBy;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $editedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $createdBy;


    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $anamnesisWastaken;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $pastIllnesses;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $accompanyingDiseases;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $familyHistory;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $premorbidDevelopment;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $earlyDevelopment;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $pregnancy;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $birth;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $neonatalPeriod;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $nutrition;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $motorDevelopment;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $speechDevelopmentAndCommunication;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $selfService;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $socialization;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $behavior;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $family;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $styleOfAttachment;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $medicalHistory;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $hospitalization;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $lastHospitalization;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $manifestationsOfAutoaggressionOrAggression;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $allergies;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $lifeStyle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $surfactantAbuse;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $problemsWithTheLaw;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $somaticStatus;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $neurologicalStatus;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $mentalStatus;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $syndrome;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $differentialDiagnosis;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $therapeuticPlan;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $therapy;

    /**
     * @ORM\OneToOne(targetEntity=Patient::class, inversedBy="psychiatricEvaluation", cascade={"persist", "remove"})
     */
    private $patient;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $youth;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $adultAge;

    public function __construct()
    {
        $this->createdBy = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

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

    public function addCreatedBy(User $createdBy): self
    {
        if (!$this->createdBy->contains($createdBy)) {
            $this->createdBy[] = $createdBy;
            $createdBy->setPsychiatricEvaluation($this);
        }

        return $this;
    }

    public function removeCreatedBy(User $createdBy): self
    {
        if ($this->createdBy->removeElement($createdBy)) {
            // set the owning side to null (unless already changed)
            if ($createdBy->getPsychiatricEvaluation() === $this) {
                $createdBy->setPsychiatricEvaluation(null);
            }
        }

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



    public function getAnamnesisWastaken(): ?string
    {
        return $this->anamnesisWastaken;
    }

    public function setAnamnesisWastaken(string $anamnesisWastaken): self
    {
        $this->anamnesisWastaken = $anamnesisWastaken;

        return $this;
    }

    public function getPastIllnesses(): ?string
    {
        return $this->pastIllnesses;
    }

    public function setPastIllnesses(string $pastIllnesses): self
    {
        $this->pastIllnesses = $pastIllnesses;

        return $this;
    }

    public function getAccompanyingDiseases(): ?string
    {
        return $this->accompanyingDiseases;
    }

    public function setAccompanyingDiseases(string $accompanyingDiseases): self
    {
        $this->accompanyingDiseases = $accompanyingDiseases;

        return $this;
    }

    public function getFamilyHistory(): ?string
    {
        return $this->familyHistory;
    }

    public function setFamilyHistory(string $familyHistory): self
    {
        $this->familyHistory = $familyHistory;

        return $this;
    }

    public function getPremorbidDevelopment(): ?string
    {
        return $this->premorbidDevelopment;
    }

    public function setPremorbidDevelopment(string $premorbidDevelopment): self
    {
        $this->premorbidDevelopment = $premorbidDevelopment;

        return $this;
    }

    public function getEarlyDevelopment(): ?string
    {
        return $this->earlyDevelopment;
    }

    public function setEarlyDevelopment(string $earlyDevelopment): self
    {
        $this->earlyDevelopment = $earlyDevelopment;

        return $this;
    }

    public function getPregnancy(): ?string
    {
        return $this->pregnancy;
    }

    public function setPregnancy(string $pregnancy): self
    {
        $this->pregnancy = $pregnancy;

        return $this;
    }

    public function getBirth(): ?string
    {
        return $this->birth;
    }

    public function setBirth(string $birth): self
    {
        $this->birth = $birth;

        return $this;
    }

    public function getNeonatalPeriod(): ?string
    {
        return $this->neonatalPeriod;
    }

    public function setNeonatalPeriod(string $neonatalPeriod): self
    {
        $this->neonatalPeriod = $neonatalPeriod;

        return $this;
    }

    public function getNutrition(): ?string
    {
        return $this->nutrition;
    }

    public function setNutrition(string $nutrition): self
    {
        $this->nutrition = $nutrition;

        return $this;
    }

    public function getMotorDevelopment(): ?string
    {
        return $this->motorDevelopment;
    }

    public function setMotorDevelopment(string $motorDevelopment): self
    {
        $this->motorDevelopment = $motorDevelopment;

        return $this;
    }

    public function getSpeechDevelopmentAndCommunication(): ?string
    {
        return $this->speechDevelopmentAndCommunication;
    }

    public function setSpeechDevelopmentAndCommunication(string $speechDevelopmentAndCommunication): self
    {
        $this->speechDevelopmentAndCommunication = $speechDevelopmentAndCommunication;

        return $this;
    }

    public function getSelfService(): ?string
    {
        return $this->selfService;
    }

    public function setSelfService(string $selfService): self
    {
        $this->selfService = $selfService;

        return $this;
    }

    public function getSocialization(): ?string
    {
        return $this->socialization;
    }

    public function setSocialization(string $socialization): self
    {
        $this->socialization = $socialization;

        return $this;
    }

    public function getBehavior(): ?string
    {
        return $this->behavior;
    }

    public function setBehavior(string $behavior): self
    {
        $this->behavior = $behavior;

        return $this;
    }

    public function getFamily(): ?string
    {
        return $this->family;
    }

    public function setFamily(string $family): self
    {
        $this->family = $family;

        return $this;
    }

    public function getStyleOfAttachment(): ?string
    {
        return $this->styleOfAttachment;
    }

    public function setStyleOfAttachment(string $styleOfAttachment): self
    {
        $this->styleOfAttachment = $styleOfAttachment;

        return $this;
    }

    public function getMedicalHistory(): ?string
    {
        return $this->medicalHistory;
    }

    public function setMedicalHistory(string $medicalHistory): self
    {
        $this->medicalHistory = $medicalHistory;

        return $this;
    }

    public function getHospitalization(): ?string
    {
        return $this->hospitalization;
    }

    public function setHospitalization(string $hospitalization): self
    {
        $this->hospitalization = $hospitalization;

        return $this;
    }

    public function getLastHospitalization(): ?string
    {
        return $this->lastHospitalization;
    }

    public function setLastHospitalization(?string $lastHospitalization): self
    {
        $this->lastHospitalization = $lastHospitalization;

        return $this;
    }

    public function getManifestationsOfAutoaggressionOrAggression(): ?string
    {
        return $this->manifestationsOfAutoaggressionOrAggression;
    }

    public function setManifestationsOfAutoaggressionOrAggression(string $manifestationsOfAutoaggressionOrAggression): self
    {
        $this->manifestationsOfAutoaggressionOrAggression = $manifestationsOfAutoaggressionOrAggression;

        return $this;
    }

    public function getAllergies(): ?string
    {
        return $this->allergies;
    }

    public function setAllergies(string $allergies): self
    {
        $this->allergies = $allergies;

        return $this;
    }

    public function getLifeStyle(): ?string
    {
        return $this->lifeStyle;
    }

    public function setLifeStyle(string $lifeStyle): self
    {
        $this->lifeStyle = $lifeStyle;

        return $this;
    }

    public function getSurfactantAbuse(): ?string
    {
        return $this->surfactantAbuse;
    }

    public function setSurfactantAbuse(string $surfactantAbuse): self
    {
        $this->surfactantAbuse = $surfactantAbuse;

        return $this;
    }

    public function getProblemsWithTheLaw(): ?string
    {
        return $this->problemsWithTheLaw;
    }

    public function setProblemsWithTheLaw(string $problemsWithTheLaw): self
    {
        $this->problemsWithTheLaw = $problemsWithTheLaw;

        return $this;
    }

    public function getSomaticStatus(): ?string
    {
        return $this->somaticStatus;
    }

    public function setSomaticStatus(string $somaticStatus): self
    {
        $this->somaticStatus = $somaticStatus;

        return $this;
    }

    public function getNeurologicalStatus(): ?string
    {
        return $this->neurologicalStatus;
    }

    public function setNeurologicalStatus(?string $neurologicalStatus): self
    {
        $this->neurologicalStatus = $neurologicalStatus;

        return $this;
    }

    public function getMentalStatus(): ?string
    {
        return $this->mentalStatus;
    }

    public function setMentalStatus(?string $mentalStatus): self
    {
        $this->mentalStatus = $mentalStatus;

        return $this;
    }

    public function getSyndrome(): ?string
    {
        return $this->syndrome;
    }

    public function setSyndrome(?string $syndrome): self
    {
        $this->syndrome = $syndrome;

        return $this;
    }

    public function getDifferentialDiagnosis(): ?string
    {
        return $this->differentialDiagnosis;
    }

    public function setDifferentialDiagnosis(?string $differentialDiagnosis): self
    {
        $this->differentialDiagnosis = $differentialDiagnosis;

        return $this;
    }

    public function getTherapeuticPlan(): ?string
    {
        return $this->therapeuticPlan;
    }

    public function setTherapeuticPlan(?string $therapeuticPlan): self
    {
        $this->therapeuticPlan = $therapeuticPlan;

        return $this;
    }

    public function getTherapy(): ?string
    {
        return $this->therapy;
    }

    public function setTherapy(string $therapy): self
    {
        $this->therapy = $therapy;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getYouth(): ?string
    {
        return $this->youth;
    }

    public function setYouth(?string $youth): self
    {
        $this->youth = $youth;

        return $this;
    }

    public function getAdultAge(): ?string
    {
        return $this->adultAge;
    }

    public function setAdultAge(?string $adultAge): self
    {
        $this->adultAge = $adultAge;

        return $this;
    }

}
