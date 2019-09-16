<?php

namespace App\Domain\Services\Dashboard\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Domain\Services\Dashboards\Controllers\IndexDashboardController;

class DashboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [];
    }
}
