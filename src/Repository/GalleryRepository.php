<?php

namespace App\Repository;

use App\Model\GalleryModel;
use App\Entity\Gallery;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
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
    public function findByVisibleAndSearch(?GalleryModel $galleryModel=null):array
    {
        $qb = $this->buildQb($galleryModel);
        if ($galleryModel && $galleryModel->getStartDatetime()){
            $qb->setMaxResults($galleryModel->getLimit());
            $qb->setFirstResult($galleryModel->getOffset());
        }

        return $qb->getQuery()->getResult();
    }

    public function countByVisibleAndSearch(?GalleryModel $galleryModel=null):int
    {
        $qb = $this->buildQb($galleryModel);
        if ($galleryModel && $galleryModel->getStartDatetime()){
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

    private function buildQb(?GalleryModel $galleryModel=null):QueryBuilder
    {
        $qb = $this->createQueryBuilder('g')
            ->where('g.isVisible = true')
            ->orderBy('g.happenedAt', 'DESC');
        if ($galleryModel && $galleryModel->getStartDatetime()){
            $qb->andWhere('g.happenedAt >= :startDate');
            $qb->setParameter('startDate', $galleryModel->getStartDatetime());
            $qb->andWhere('g.happenedAt < :endDate');
            $qb->setParameter('endDate', $galleryModel->getEndDatetime());
        }
        return $qb;
    }

    public function findNonEmptyMonths(GalleryModel $galleryModel):array
    {

        $result = $this->buildQb(new GalleryModel(startYear: $galleryModel->getStartYear()))
            ->getQuery()
            ->getResult()
        ;
        $result = (new ArrayCollection($result))
            ->map(fn(Gallery $gallery):int => (int)$gallery->getHappenedAt()
            ->format('m'));

        return array_unique($result->toArray());
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
