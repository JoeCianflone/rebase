<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Traits\EloquentReads;
use App\Domain\Traits\EloquentWrites;

class EloquentRepository
{
    use EloquentWrites;
    use EloquentReads;

    protected array $data = [];

    protected Model $model;

    protected int $cacheTime = 300;

    protected string $cacheKey = '';

    public function cache(string $name, Closure $fn)
    {
        return Cache::remember("{$this->cacheKey}__{$name}__", $this->cacheTime, $fn);
    }
}
