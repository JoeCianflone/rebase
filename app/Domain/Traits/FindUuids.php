<?php

namespace App\Domain\Traits;

trait FindUuids
{
    public function uuidColumns(): array
    {
        return  collect($this->casts)->filter(function ($value, $key) {
            return 'Dyrynda\Database\Casts\EfficientUuid' === $value;
        })->keys()->toArray();
    }
}
