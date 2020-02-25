<?php
namespace App\Domain\Resources;

use App\Http\Resources\HasMeta;
use Illuminate\Support\Collection;

class UserResource extends Resource
{

    public function toArray($resource): array
    {
        return [
            'id' => $resource->get('id'),
            'name' => $resource->get('name'),
            'email' => $resource->get('email'),
        ];
    }

    public function links(): array
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

    public function meta(): array
    {
        return [
            'one' => 'one',
            'two' => true
        ];
    }

}
