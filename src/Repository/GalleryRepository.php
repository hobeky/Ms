<?php

namespace App\Repository;

use App\DTO\GallerySearchDto;
use App\Entity\Gallery;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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

    public function findByVisibleAndSearch(?GallerySearchDto $searchDto=null)
    {
        $qb = $this->createQueryBuilder('g')
            ->where('g.isVisible = true')
            ->orderBy('g.happenedAt', 'ASC');
        if ($searchDto && $searchDto->getDatetime()){
            $qb->andWhere('g.happenedAt > :startDate');
            $qb->setParameter('startDate', $searchDto->getDatetime());
        }
        return $qb->getQuery()->getResult();
    }

    public function getOldestRecord(): ?Gallery
    {
        return $this->createQueryBuilder('g')
            ->orderBy('g.happenedAt', 'ASC')
            ->getQuery()
            ->getOneOrNullResult();
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
