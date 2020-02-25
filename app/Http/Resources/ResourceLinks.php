<?php
namespace App\Http\Resources;

use Illuminate\Support\Collection;

class ResourceLinks {

    private Collection $rawLinks;
    private ?Collection $links = null;
    private ?Collection $hydratedLinks = null;

    public function __construct(Collection $links)
    {
        $this->rawLinks = $links;
    }

    public function all(): self
    {
        $this->links = $this->rawLinks;

        return $this;
    }

    public function except(...$links): self
    {
        $this->links = $this->rawLinks->except(...$links);
        $this->hydratedLinks = null;

        return $this;
    }

    public function only(...$links): self
    {
        $this->links = $this->rawLinks->only(...$links);
        $this->hydratedLinks = null;

        return $this;
    }

    public function hydrate(Collection $item): self
    {
        $this->hydratedLinks = $this->links->map(function($link) use ($item) {

            preg_match_all('/\{([\w\-]+)\}/', $link, $output);
            list($search, $replacement) = $output;

            for ($i = 0; $i < count($search); $i++) {
                $link = str_replace("{$search[$i]}", $item->get($replacement[$i]), $link);
            }

            return $link;
        });

        return $this;
    }

    public function toArray(): array
    {
        if (is_null($this->hydratedLinks)) {
            return $this->links->toArray();
        }

        return $this->hydratedLinks->toArray();
    }
}

