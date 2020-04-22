<?php declare(strict_types=1);

namespace App\Helpers;

use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class QueryCache
{
    private Cache $cache;

    private string $key;

    private int $seconds = 300;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function setKey(string $key): void
    {
        $this->key .= ".{$key}";
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function for(int $seconds): self
    {
        $this->seconds = $seconds;

        return $this;
    }

    public function as(string $name): self
    {
        $this->key .= ".{$name}";

        return $this;
    }

    /**
     * @return mixed
     */
    public function from(Closure $func)
    {
        return Cache::remember($this->key, $this->seconds, $func);
    }
}
