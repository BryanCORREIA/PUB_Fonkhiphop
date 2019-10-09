<?php

namespace App\Repository;

use App\Entity\CategoryInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CategoryInfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryInfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryInfo[]    findAll()
 * @method CategoryInfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryInfoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CategoryInfo::class);
    }

    // /**
    //  * @return CategoryInfo[] Returns an array of CategoryInfo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategoryInfo
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
