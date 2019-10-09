<?php

namespace App\Repository;

use App\Entity\TypeEnv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeEnv|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeEnv|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeEnv[]    findAll()
 * @method TypeEnv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeEnvRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeEnv::class);
    }

    // /**
    //  * @return TypeEnv[] Returns an array of TypeEnv objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeEnv
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
