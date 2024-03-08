<?php

namespace App\Repository;

use App\Entity\FormChamps;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FormChamps>
 *
 * @method FormChamps|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormChamps|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormChamps[]    findAll()
 * @method FormChamps[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormChampsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormChamps::class);
    }

//    /**
//     * @return FormChamps[] Returns an array of FormChamps objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FormChamps
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
