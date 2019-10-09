<?php

namespace App\Repository;

use App\Entity\Stage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Stage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stage[]    findAll()
 * @method Stage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Stage::class);
    }

    /**
     * @param $month
     * @param $year
     * @return Stage[]
     */
    public function findAllStageInMonth($month, $year, $privated)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('MONTH(e.date_start) = :month OR MONTH(e.date_end) = :month')
            ->andWhere('YEAR(e.date_start) = :year OR YEAR(e.date_end) = :year')
            ->andWhere('e.privated = :privated')
            ->setParameter('month', $month)
            ->setParameter('year', $year)
            ->setParameter('privated', $privated)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Stage|\Exception
     * @throws \Exception
     */
    public function getNextStage()
    {
        try {
            return $this->createQueryBuilder('s')
                ->where('s.date_start > :current_date')
                ->orderBy('s.date_start', 'ASC')
                ->setParameter('current_date', new \DateTime())
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return $e;
        }
    }

    /*
    public function findOneBySomeField($value): ?Stage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
