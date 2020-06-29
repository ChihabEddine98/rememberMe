<?php

namespace App\Repository;

use App\Entity\Shares;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Shares|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shares|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shares[]    findAll()
 * @method Shares[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SharesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shares::class);
    }

    // /**
    //  * @return Shares[] Returns an array of Shares objects
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
    public function findOneBySomeField($value): ?Shares
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
