<?php
namespace App\Domain\Services\Dashboard\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DashboardResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
