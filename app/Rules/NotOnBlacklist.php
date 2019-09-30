<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Domain\Repositories\Facades\BlacklistRepository;

class NotOnBlacklist implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !BlacklistRepository::hasSlug($value);
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
