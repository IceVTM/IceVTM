<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use RandomLib\Factory;
use RandomLib\Generator;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DriverTokenRepository")
 */
class DriverToken
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $token;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="driverTokens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TakenJob", mappedBy="driverToken")
     */
    private $takenJobs;

    public function __construct()
    {
        $this->takenJobs = new ArrayCollection();

        $factory = new Factory;
        $generator = $factory->getMediumStrengthGenerator();
        $this->setToken($generator->generateString(40, Generator::CHAR_ALNUM));
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return DriverToken
     */
    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return DriverToken
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     * @return DriverToken
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|TakenJob[]
     */
    public function getTakenJobs(): Collection
    {
        return $this->takenJobs;
    }

    /**
     * @param TakenJob $takenJob
     * @return DriverToken
     */
    public function addTakenJob(TakenJob $takenJob): self
    {
        if (!$this->takenJobs->contains($takenJob)) {
            $this->takenJobs[] = $takenJob;
            $takenJob->setDriverToken($this);
        }

        return $this;
    }

    /**
     * @param TakenJob $takenJob
     * @return DriverToken
     */
    public function removeTakenJob(TakenJob $takenJob): self
    {
        if ($this->takenJobs->contains($takenJob)) {
            $this->takenJobs->removeElement($takenJob);
            // set the owning side to null (unless already changed)
            if ($takenJob->getDriverToken() === $this) {
                $takenJob->setDriverToken(null);
            }
        }

        return $this;
    }
}
