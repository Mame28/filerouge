<?php

namespace App\Repository;

use App\Entity\TaxeEtats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TaxeEtats|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaxeEtats|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaxeEtats[]    findAll()
 * @method TaxeEtats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaxeEtatsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaxeEtats::class);
    }

    // /**
    //  * @return TaxeEtats[] Returns an array of TaxeEtats objects
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
    public function findOneBySomeField($value): ?TaxeEtats
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
