<?php

namespace App\Repository;

use App\Entity\Monetique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Monetique>
 *
 * @method Monetique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Monetique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Monetique[]    findAll()
 * @method Monetique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MonetiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Monetique::class);
    }

//    /**
//     * @return Monetique[] Returns an array of Monetique objects
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

//    public function findOneBySomeField($value): ?Monetique
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
