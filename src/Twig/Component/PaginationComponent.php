<?php

declare(strict_types=1);

namespace App\Twig\Component;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(name: 'pagination', template: 'component/pagination.html.twig')]
final class PaginationComponent
{
    public int $nearby_pages_limit = 4;

    public int $total_items;

    public int $total_pages;

    public int $page;

    public string $route;

    /** @var array<string> */
    public array $params = [];

    /**
     * @param array<mixed> $data
     *
     * @return array<mixed>
     */
    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();
        $resolver->setRequired(['total_items', 'total_pages', 'page', 'route', 'params']);
        $resolver->setDefault('params', []);

        return $resolver->resolve($data);
    }
}
