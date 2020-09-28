<?php

declare(strict_types=1);

namespace App\Domain\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static ?\Illuminate\Support\Collection all()
 * @method static ?\App\Domain\Models\BannedSlug getByID(\Ramsey\Uuid\Uuid $id)
 * @method static \App\Domain\Models\BannedSlug create(array $request)
 * @method static \App\Domain\Models\BannedSlug refresh(\App\Domain\Models\BannedSlug $model)
 * @method static void update(int|\Ramsey\Uuid\Uuid $id)
 * @method static void remove(\App\Domain\Models\BannedSlug $model)
 * @method static \App\Domain\Facades\BannedSlugRepository with(array $data)
 * @method static \App\Domain\Facades\BannedSlugRepository purge()
 * @method static bool hasSlug(string $slug)
 * @method static bool doesNotHaveSlug(string $slug)
 */
class BannedSlugRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'BannedSlugRepository';
    }
}
