<?php

namespace App\Repository;

use App\Entity\MonetiqueDroitVariable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MonetiqueDroitVariable>
 *
 * @method MonetiqueDroitVariable|null find($id, $lockMode = null, $lockVersion = null)
 * @method MonetiqueDroitVariable|null findOneBy(array $criteria, array $orderBy = null)
 * @method MonetiqueDroitVariable[]    findAll()
 * @method MonetiqueDroitVariable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MonetiqueDroitVariableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MonetiqueDroitVariable::class);
    }

//    /**
//     * @return MonetiqueDroitVariable[] Returns an array of MonetiqueDroitVariable objects
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

//    public function findOneBySomeField($value): ?MonetiqueDroitVariable
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
