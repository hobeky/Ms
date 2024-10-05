<?php

namespace App\Repository;

use App\DTO\GallerySearchDto;
use App\Entity\Gallery;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Gallery>
 */
class GalleryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gallery::class);
    }

    /**
     * @return Gallery[]
     */
    public function findByVisibleAndSearch(?GallerySearchDto $searchDto=null):array
    {
        $qb = $this->buildQb($searchDto);
        if ($searchDto && $searchDto->getStartDatetime()){
            $qb->setMaxResults($searchDto->getLimit());
            $qb->setFirstResult($searchDto->getOffset());
        }

        return $qb->getQuery()->getResult();
    }

    public function countByVisibleAndSearch(?GallerySearchDto $searchDto=null):int
    {
        $qb = $this->buildQb($searchDto);
        if ($searchDto && $searchDto->getStartDatetime()){
            $qb->select('count(g.id)');
            $qb->setMaxResults(1);
            $qb->setFirstResult(0);
        }

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function getOldestRecord(): ?Gallery
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.isVisible = true')
            ->orderBy('g.happenedAt', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
    
    private function buildQb(?GallerySearchDto $searchDto=null):QueryBuilder
    {
        $qb = $this->createQueryBuilder('g')
            ->where('g.isVisible = true')
            ->orderBy('g.happenedAt', 'ASC');
        if ($searchDto && $searchDto->getStartDatetime()){
            $qb->andWhere('g.happenedAt >= :startDate');
            $qb->setParameter('startDate', $searchDto->getStartDatetime());
            $qb->andWhere('g.happenedAt < :endDate');
            $qb->setParameter('endDate', $searchDto->getEndDatetime());
            $qb->setMaxResults($searchDto->getLimit());
            $qb->setFirstResult($searchDto->getOffset());
        }
        return $qb;
    }

//    /**
//     * @return Gallery[] Returns an array of Gallery objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Gallery
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
