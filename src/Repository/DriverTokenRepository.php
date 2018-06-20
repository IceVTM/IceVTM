<?php

namespace App\Repository;

use App\Entity\DriverToken;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DriverToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method DriverToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method DriverToken[]    findAll()
 * @method DriverToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DriverTokenRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DriverToken::class);
    }

    public function findActiveDriverTokenByUser(User $user)
    {
        return $this->findOneBy(
            [
                'user' => $user
            ],
            [
                'createdAt' => 'DESC'
            ]
        );
    }

    public function findActiveDriverTokenByToken($token)
    {
        $driverToken = $this->findOneBy([
            'token' => $token
        ]);

        if (!$driverToken) {
            return null;
        }

        $userCurrentDriverToken = $this->findActiveDriverTokenByUser($driverToken->getUser());

        return $userCurrentDriverToken->getToken() === $driverToken->getToken() ? $driverToken : null;
    }
}
