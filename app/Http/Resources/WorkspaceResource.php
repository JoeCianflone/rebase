<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Support\Collection;
use JoeCianflone\InertiaResource\Resource;

class WorkspaceResource extends Resource
{
    public function toArray(Collection $resource): array
    {
        return [];
    }

    public static function links(): array
    {
        return [];
    }

    public static function meta(): array
    {
        return [];
    }
}
