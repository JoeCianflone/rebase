<?php

namespace App\Rules;

use App\Domain\Repositories\Facades\BanlistRepository;
use Illuminate\Contracts\Validation\Rule;

class NotOnBanlist implements Rule
{
    /**
     * Create a new rule instance.
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !BanlistRepository::hasSlug($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'That name cannot be used in our system';
    }
}
