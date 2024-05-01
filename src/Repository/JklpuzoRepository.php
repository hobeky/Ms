<?php

namespace App\Repository;

use App\Entity\Jklpuzo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Jklpuzo>
 *
 * @method Jklpuzo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jklpuzo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jklpuzo[]    findAll()
 * @method Jklpuzo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JklpuzoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Jklpuzo::class);
    }

    //    /**
    //     * @return Jklpuzo[] Returns an array of Jklpuzo objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('j')
    //            ->andWhere('j.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('j.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Jklpuzo
    //    {
    //        return $this->createQueryBuilder('j')
    //            ->andWhere('j.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
