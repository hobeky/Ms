<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\HeroExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class HeroExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('hero_image', [HeroExtensionRuntime::class, 'heroImage']),
        ];
    }
}
