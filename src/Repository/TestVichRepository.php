<?php

namespace App\Repository;

use App\Entity\TestVich;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TestVich|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestVich|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestVich[]    findAll()
 * @method TestVich[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestVichRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestVich::class);
    }

    // /**
    //  * @return TestVich[] Returns an array of TestVich objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TestVich
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
