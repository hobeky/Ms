<?php

namespace App\Twig\Runtime;

use App\Entity\Hero;
use App\Repository\HeroRepository;
use Twig\Extension\RuntimeExtensionInterface;

class HeroExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(
            private readonly HeroRepository $heroRepository

    )
    {
        // Inject dependencies if needed
    }

    public function heroImage(): ?Hero
    {
        $queryBuilder = $this->heroRepository->createQueryBuilder('h');
        $queryBuilder->orderBy('RAND()')
            ->setMaxResults(1);

        $query = $queryBuilder->getQuery();
        /** @var ?Hero $randomHero */
        $randomHero = $query->getOneOrNullResult();

        return $randomHero;
    }
}
