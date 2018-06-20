<?php

namespace App\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class TakenJob
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DriverToken", inversedBy="takenJobs")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="token")
     */
    private $driverToken;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $addedAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string")
     */
    private $game;

    /**
     * @ORM\Column(type="string")
     */
    private $pickupCity;

    /**
     * @ORM\Column(type="string")
     */
    private $destinationCity;

    /**
     * @ORM\Column(type="string")
     */
    private $estimatedIncome;

    /**
     * @ORM\Column(type="string")
     */
    private $cargo;

    /**
     * @ORM\Column(type="string")
     */
    private $pickupCompany;

    /**
     * @ORM\Column(type="string")
     */
    private $destinationCompany;

    /**
     * @ORM\Column(type="datetime")
     */
    private $deadlineTime;

    /**
     * @ORM\Column(type="float")
     */
    private $trailerWear;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return DriverToken|null
     */
    public function getDriverToken(): ?DriverToken
    {
        return $this->driverToken;
    }

    /**
     * @param DriverToken|null $driverToken
     */
    public function setDriverToken(?DriverToken $driverToken)
    {
        $this->driverToken = $driverToken;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getAddedAt(): ?\DateTimeInterface
    {
        return $this->addedAt;
    }

    /**
     * @param \DateTimeInterface $addedAt
     */
    public function setAddedAt(\DateTimeInterface $addedAt)
    {
        $this->addedAt = $addedAt;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface $updatedAt
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return null|string
     */
    public function getGame(): ?string
    {
        return $this->game;
    }

    /**
     * @param string $game
     */
    public function setGame(string $game)
    {
        $this->game = $game;
    }

    /**
     * @return null|string
     */
    public function getPickupCity(): ?string
    {
        return $this->pickupCity;
    }

    /**
     * @param string $pickupCity
     */
    public function setPickupCity(string $pickupCity)
    {
        $this->pickupCity = $pickupCity;
    }

    /**
     * @return null|string
     */
    public function getDestinationCity(): ?string
    {
        return $this->destinationCity;
    }

    /**
     * @param string $destinationCity
     */
    public function setDestinationCity(string $destinationCity)
    {
        $this->destinationCity = $destinationCity;
    }

    /**
     * @return null|string
     */
    public function getEstimatedIncome(): ?string
    {
        return $this->estimatedIncome;
    }

    /**
     * @param string $estimatedIncome
     */
    public function setEstimatedIncome(string $estimatedIncome)
    {
        $this->estimatedIncome = $estimatedIncome;
    }

    /**
     * @return null|string
     */
    public function getCargo(): ?string
    {
        return $this->cargo;
    }

    /**
     * @param string $cargo
     */
    public function setCargo(string $cargo)
    {
        $this->cargo = $cargo;
    }

    /**
     * @return null|string
     */
    public function getPickupCompany(): ?string
    {
        return $this->pickupCompany;
    }

    /**
     * @param string $pickupCompany
     */
    public function setPickupCompany(string $pickupCompany)
    {
        $this->pickupCompany = $pickupCompany;
    }

    /**
     * @return null|string
     */
    public function getDestinationCompany(): ?string
    {
        return $this->destinationCompany;
    }

    /**
     * @param string $destinationCompany
     */
    public function setDestinationCompany(string $destinationCompany)
    {
        $this->destinationCompany = $destinationCompany;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDeadlineTime(): ?\DateTimeInterface
    {
        return $this->deadlineTime;
    }

    /**
     * @param \DateTimeInterface $deadlineTime
     */
    public function setDeadlineTime(\DateTimeInterface $deadlineTime)
    {
        $this->deadlineTime = $deadlineTime;
    }

    /**
     * @return float|null
     */
    public function getTrailerWear(): ?float
    {
        return $this->trailerWear;
    }

    /**
     * @param float $trailerWear
     */
    public function setTrailerWear(float $trailerWear)
    {
        $this->trailerWear = $trailerWear;
    }
}
