<?php

namespace App\Repository;

use App\Entity\MonetiqueDroit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MonetiqueDroit>
 *
 * @method MonetiqueDroit|null find($id, $lockMode = null, $lockVersion = null)
 * @method MonetiqueDroit|null findOneBy(array $criteria, array $orderBy = null)
 * @method MonetiqueDroit[]    findAll()
 * @method MonetiqueDroit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MonetiqueDroitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MonetiqueDroit::class);
    }

//    /**
//     * @return MonetiqueDroit[] Returns an array of MonetiqueDroit objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MonetiqueDroit
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
