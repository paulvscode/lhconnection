<?php

namespace App\Repository;

use App\Entity\Responsible;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Responsible|null find($id, $lockMode = null, $lockVersion = null)
 * @method Responsible|null findOneBy(array $criteria, array $orderBy = null)
 * @method Responsible[]    findAll()
 * @method Responsible[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResponsibleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Responsible::class);
    }

    // /**
    //  * @return Responsible[] Returns an array of Responsible objects
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

//    public function findResponsibleByProjectId()
//    {
//        $entityManager = $this->getEntityManager();
//        $queryBuilder = $entityManager->createQueryBuilder();
//
//        $query = $queryBuilder
//            ->select('r.name')
//            ->from(Responsible::class, 'r')
//            ->join('r.projects', 'rp')
//            ->getQuery();
//        ;
//
//        return $query->execute();
//    }
}