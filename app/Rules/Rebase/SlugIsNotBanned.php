<?php

namespace App\Rules\Rebase;

use App\Domain\Models\Rebase\Admin\BannedSlug;
use Illuminate\Contracts\Validation\Rule;

class SlugIsNotBanned implements Rule
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
        return is_string($value) && !BannedSlug::slugExists($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'That :attribute is not allowed';
    }
}
