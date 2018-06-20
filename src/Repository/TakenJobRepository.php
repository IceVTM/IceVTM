<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class TakenJobRepository extends EntityRepository
{
    /**
     * @param string $property
     * @param array $criteria
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function sumOf($property, $criteria = [])
    {
        $qb = $this->createQueryBuilder('tj')
            ->select('SUM(tj.' . $property . ')');

        if ($criteria) {
            $qb->where(array_reduce(array_keys($criteria), function ($carry, $item) use ($criteria) {
                    $operator = '=';
                    if (is_array($criteria[$item])) {
                        $operator  = 'IN';
                    }

                    return ($carry ? $carry . ' AND ' : '') . 'tj.' . $item . ' ' . $operator . ' (:' . $item . ')';
                }, ''))
                ->setParameters($criteria);
        }

        return $qb->getQuery()->getSingleScalarResult();
    }
}
