<?php
namespace App\Domain\Resources;

use Illuminate\Support\Collection;


abstract class Resource {


    private Collection $items;
    private array $resource;

    private const LINKS = 'links';
    private const DATA = 'data';
    private const META = 'meta';

    public function __construct(array $items)
    {
        $this->items = collect($items);

        $this->buildResource(collect($items));
    }


    public abstract function links(): array;



    public function buildResouce($items)
    {
        $this->resource[self::DATA] = $items->map(function($item) {
            return array_merge($this->toArray($item), $this->setItemLinks($item));
        });
    }


    public function setItemLinks($item)
    {



    }

    public function collect(): array
    {
        $this->resource['data'] = $this->items->map(function($i) {
            return array_merge($this->toArray(collect($i)), $this->linkable('single', $i['id']));
        })->toArray();

        $this->appendLinks($this->links());
        // $this->appendMeta();

        return $this->resource;
    }

    public function appendLinks(array $links): void
    {
        $this->resource['meta'] = $this->linkable();
    }


    public function metaLinks(...$replacements): array
    {
        return [
            self::LINKS => collect($this->links())->only('index', 'create', 'store')->toArray()
        ];
    }


    private function linkReplacement(...$replacements): string
    {
        $count = 1;

        foreach($replacements as $replacement) {
            $hydratedLink = str_replace("{{$i}}", $replacement, $link);
            $i += 1;
        }
    }

    public function linkable($type = 'meta', ...$replacements)
    {

        return [
            'links' => collect($this->links())->except('index', 'create', 'store')->map(function($link) use($replacements) {
                $i = 1;
                foreach($replacements as $replacement) {
                    $hydratedLink = str_replace("{{$i}}", $replacement, $link);
                    $i += 1;
                }

                return $hydratedLink;

            })->toArray()
        ];
    }

    public function link($key): ?string
    {
        return collect($this->links())->get($key);
    }


    public static function meta()
    {
        return [];
    }
}
