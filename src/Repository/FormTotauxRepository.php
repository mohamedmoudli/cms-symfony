<?php

namespace App\Repository;

use App\Entity\FormTotaux;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FormTotaux>
 *
 * @method FormTotaux|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormTotaux|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormTotaux[]    findAll()
 * @method FormTotaux[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormTotauxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormTotaux::class);
    }

//    /**
//     * @return FormTotaux[] Returns an array of FormTotaux objects
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

//    public function findOneBySomeField($value): ?FormTotaux
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
