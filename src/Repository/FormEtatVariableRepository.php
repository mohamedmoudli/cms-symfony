<?php

namespace App\Repository;

use App\Entity\FormEtatVariable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FormEtatVariable>
 *
 * @method FormEtatVariable|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormEtatVariable|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormEtatVariable[]    findAll()
 * @method FormEtatVariable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormEtatVariableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormEtatVariable::class);
    }

//    /**
//     * @return FormEtatVariable[] Returns an array of FormEtatVariable objects
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

//    public function findOneBySomeField($value): ?FormEtatVariable
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
