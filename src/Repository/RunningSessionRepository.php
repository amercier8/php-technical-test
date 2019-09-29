<?php

namespace App\Repository;

use App\Entity\RunningSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RunningSession|null find($id, $lockMode = null, $lockVersion = null)
 * @method RunningSession|null findOneBy(array $criteria, array $orderBy = null)
 * @method RunningSession[]    findAll()
 * @method RunningSession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RunningSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RunningSession::class);
    }

    // /**
    //  * @return RunningSession[] Returns an array of RunningSession objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RunningSession
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
