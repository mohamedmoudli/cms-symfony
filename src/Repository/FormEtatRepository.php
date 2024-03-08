<?php

namespace App\Repository;

use App\Entity\FormEtat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FormEtat>
 *
 * @method FormEtat|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormEtat|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormEtat[]    findAll()
 * @method FormEtat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormEtatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormEtat::class);
    }

//    /**
//     * @return FormEtat[] Returns an array of FormEtat objects
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

//    public function findOneBySomeField($value): ?FormEtat
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
