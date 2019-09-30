<?php
namespace App\Domain\Services\Blacklists\Resources;

use App\Http\Resources\HasItem;
use App\Http\Resources\HasMeta;
use Illuminate\Http\Resources\Json\JsonResource;

class BlacklistResource extends JsonResource
{
    use HasMeta, HasItem;

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'description' => $this->description,
        ];
    }

    public static function meta()
    {
        return [];
    }
}
