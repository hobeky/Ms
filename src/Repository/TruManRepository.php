<?php

namespace App\Repository;

use App\Entity\TruMan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TruMan>
 *
 * @method TruMan|null find($id, $lockMode = null, $lockVersion = null)
 * @method TruMan|null findOneBy(array $criteria, array $orderBy = null)
 * @method TruMan[]    findAll()
 * @method TruMan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TruManRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TruMan::class);
    }

    //    /**
    //     * @return TruMan[] Returns an array of TruMan objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?TruMan
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
