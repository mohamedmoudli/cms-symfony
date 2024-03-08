<?php

namespace App\Repository;

use App\Entity\FormStepChamps;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FormStepChamps>
 *
 * @method FormStepChamps|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormStepChamps|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormStepChamps[]    findAll()
 * @method FormStepChamps[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormStepChampsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormStepChamps::class);
    }

//    /**
//     * @return FormStepChamps[] Returns an array of FormStepChamps objects
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

//    public function findOneBySomeField($value): ?FormStepChamps
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
