<?php

namespace App\Rules\Rebase;

use Illuminate\Contracts\Validation\Rule;
use App\Domain\Models\Rebase\Admin\BannedSubdomain;

class SubdomainIsNotBanned implements Rule
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
        return is_string($value) && !BannedSubdomain::subExists($value);
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
