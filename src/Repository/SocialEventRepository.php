<?php

namespace App\Repository;

use App\Entity\SocialEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SocialEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method SocialEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method SocialEvent[]    findAll()
 * @method SocialEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SocialEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SocialEvent::class);
    }

    // /**
    //  * @return SocialEvent[] Returns an array of SocialEvent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SocialEvent
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
