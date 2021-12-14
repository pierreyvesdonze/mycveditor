<?php

namespace App\Repository;

use App\Entity\ExperienceLine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExperienceLine|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExperienceLine|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExperienceLine[]    findAll()
 * @method ExperienceLine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExperienceLineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExperienceLine::class);
    }

    // /**
    //  * @return ExperienceLine[] Returns an array of ExperienceLine objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExperienceLine
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
