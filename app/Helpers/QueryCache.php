<?php

declare(strict_types=1);

namespace App\Helpers;

use Closure;
use Illuminate\Support\Facades\Cache;

class QueryCache
{
    private string $key;

    private string $name = '';

    private int $seconds = 300;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function for(int $seconds): self
    {
        $this->seconds = $seconds;

        return $this;
    }

    public function as(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function execute(Closure $func)
    {
        $fullCacheKey = "{$this->key}.{$this->name}";

        return Cache::remember($fullCacheKey, $this->seconds, $func);
    }
}
