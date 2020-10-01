<?php

namespace App\Domain\Traits;

trait FindUuidColumns
{
    private string $className = 'Dyrynda\Database\Casts\EfficientUuid';

    public function allUuidColumns(array $casts): array
    {
        return  collect($casts)->filter(function ($value, $key) {
            return $this->className === $value;
        })->keys()->toArray();
    }
}
