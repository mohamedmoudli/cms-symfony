<?php

namespace App\Repository;

use App\Entity\FormChampsOption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FormChampsOption>
 *
 * @method FormChampsOption|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormChampsOption|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormChampsOption[]    findAll()
 * @method FormChampsOption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormChampsOptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormChampsOption::class);
    }

//    /**
//     * @return FormChampsOption[] Returns an array of FormChampsOption objects
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

//    public function findOneBySomeField($value): ?FormChampsOption
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
