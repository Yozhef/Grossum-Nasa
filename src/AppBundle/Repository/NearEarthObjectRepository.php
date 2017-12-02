<?php

namespace AppBundle\Repository;

use AppBundle\Entity\NearEarthObject;
use Doctrine\ORM\EntityRepository;


/**
 * NearEarthObjectRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NearEarthObjectRepository extends EntityRepository
{
    /**
     * @param int $referenceId
     *
     * @return NearEarthObject|null
     */
    public function getNeoByReferenceId(int $referenceId)
    {
        $qb = $this->createQueryBuilder('neo');

        return $qb
            ->select()
            ->andWhere('neo.reference =:reference_id')
            ->setParameter('reference_id', $referenceId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return array
     */
    public function findHazardous()
    {
        $qb = $this->createQueryBuilder('neo');

        return $qb
            ->select()
            ->andWhere('neo.isHazardous =:hazardous')
            ->setParameter('hazardous', true)
            ->getQuery()
            ->getResult();
    }

    public function getFastestAndHazardous(bool $hazardous, $limit = 1)
    {
        $qb = $this->createQueryBuilder('neo');
        return $qb
            ->select()
            ->andWhere('neo.isHazardous =:hazardous')
            ->setParameter('hazardous', $hazardous)
            ->addOrderBy('neo.speed', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

}
