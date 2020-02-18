<?php
namespace App\Domain\Resources;

use App\Http\Resources\HasMeta;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    use HasMeta;

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email
        ];
    }

    public function meta()
    {
        return [
            'create' => 'users/create'
        ];
    }

}
