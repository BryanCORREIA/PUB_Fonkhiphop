<?php

namespace App\Repository;

use App\Entity\Annulation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Annulation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annulation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annulation[]    findAll()
 * @method Annulation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnulationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Annulation::class);
    }

    /**
     * @param $month
     * @param $year
     * @return Annulation[]
     */
    public function findAllAnnulsInMonth($month, $year)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('MONTH(e.date_annulation) = :month')
            ->andWhere('YEAR(e.date_annulation) = :year')
            ->setParameter('month', $month)
            ->setParameter('year', $year)
            ->getQuery()
            ->getResult()
            ;
    }

    /*
    public function findOneBySomeField($value): ?Annulation
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
