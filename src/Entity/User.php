<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DriverToken", mappedBy="user", orphanRemoval=true)
     */
    private $driverTokens;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        parent::__construct();

        $this->driverTokens = new ArrayCollection();
    }

    /**
     * @return Collection|DriverToken[]
     */
    public function getDriverTokens(): Collection
    {
        return $this->driverTokens;
    }

    /**
     * @param DriverToken $driverToken
     * @return User
     */
    public function addDriverToken(DriverToken $driverToken): self
    {
        if (!$this->driverTokens->contains($driverToken)) {
            $this->driverTokens[] = $driverToken;
            $driverToken->setUser($this);
        }

        return $this;
    }

    /**
     * @param DriverToken $driverToken
     * @return User
     */
    public function removeDriverToken(DriverToken $driverToken): self
    {
        if ($this->driverTokens->contains($driverToken)) {
            $this->driverTokens->removeElement($driverToken);
            // set the owning side to null (unless already changed)
            if ($driverToken->getUser() === $this) {
                $driverToken->setUser(null);
            }
        }

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
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
