<?php

namespace App\Repository;

use App\Entity\MonetiqueType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MonetiqueType>
 *
 * @method MonetiqueType|null find($id, $lockMode = null, $lockVersion = null)
 * @method MonetiqueType|null findOneBy(array $criteria, array $orderBy = null)
 * @method MonetiqueType[]    findAll()
 * @method MonetiqueType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MonetiqueTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MonetiqueType::class);
    }

//    /**
//     * @return MonetiqueType[] Returns an array of MonetiqueType objects
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

//    public function findOneBySomeField($value): ?MonetiqueType
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
