<?php
namespace App\Domain\Resources;

use Illuminate\Support\Collection;


abstract class Resource {

    private Collection $items;
    private array $resource;

    private const LINKS = 'links';
    private const DATA  = 'data';
    private const META  = 'meta';

    public abstract function links(): array;
    public abstract function meta(): array;

    public function __construct(array $items)
    {
        $this->items = collect($items);
        $this->buildResource(collect($items));
    }

    public function buildResource(Collection $items): void
    {
        $links = new ResourceLinks(collect($this->links()));

        $this->resource = [
            self::DATA => $items->map(function($item) use ($links) {
                return array_merge(
                    $this->toArray(collect($item)),
                    $this->getItemLinks(collect($item), $links),
                );
            })->toArray(),

            self::META => array_merge(
                $this->meta(),
                $this->getMetaLinks($links),
            )
        ];
    }

    public function getItemLinks(Collection $item, ResourceLinks $links): array
    {
        return [
            self::LINKS => $links->except('index', 'create', 'store')->hydrate($item)->toArray()
        ];
    }

    public function getMetaLinks(ResourceLinks $links): array
    {
        return [
            self::LINKS => $links->only('index', 'create', 'store')->toArray()
        ];
    }

    public function collect()
    {
        return $this->resource;
    }
}
