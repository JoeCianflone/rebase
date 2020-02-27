<?php
namespace App\Http\Resources;

use Illuminate\Support\Collection;
use JoeCianflone\InertiaResource\Resource;

class UserResource extends Resource
{

    /**
     * @param Collection $resource
     * @return array
     */
    public function toArray(Collection $resource): array
    {
        return [
            'id' => $resource->get('id'),
            'name' => $resource->get('name'),
            'email' => $resource->get('email'),
        ];
    }

    /**
     * @return array
     */
    public static function links(): array
    {
        return [
            'index' => '/users',
            'create' => '/users/create',
            'store' => '/users',
            'show' => '/users/{id}',
            'edit' => '/users/{id}/edit',
            'update' => '/users/{id}',
            'destroy' => '/users/{id}',
        ];
    }

    /**
     * @return array
     */
    public static function meta(): array
    {
        return [
            "is_logged_in" => true
        ];
    }

}
