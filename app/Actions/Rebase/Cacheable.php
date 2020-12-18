<?php declare(strict_types=1);

namespace App\Actions\Rebase;

use App\Contracts\Rebase\Actionable;
use Illuminate\Support\Facades\Cache;

class Cacheable implements Actionable
{
    public static function handle(...$payload): string
    {
        $query = $payload[0];
        $time = $payload[1] ?? 300;
        return Cache::remember(md5($query), $time, fn() => $query);

    }
}
