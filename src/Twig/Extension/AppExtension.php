<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\AppExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('filter_name', [AppExtensionRuntime::class, 'doSomething']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('pluralize', [$this, 'doSomething']),
        ];
    }
    /**
     * La function permets de definier si le pins est au pluriel ou au singulier
     *
     * @param integer $count
     * @param string $singular
     * @param string $plural
     * @return string
     */
    public function doSomething(int $count, string $singular, ?string $plural = null) : string
    {
        $plural ??= $singular . 's' ;
        $str = $count === 1 ? $singular : $plural;
        return "$count $str";
    }
}
