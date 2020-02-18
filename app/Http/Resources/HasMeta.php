<?php
namespace App\Http\Resources;

trait HasMeta
{

    public static function collection($resource)
    {
        return [
            'data' => parent::collection($resource),
            'meta' => self::meta(),
        ];
    }

    public static function meta()
    {
        return [];
    }
}
