<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Domain\Repositories\Facades\BannedSlugRepository;

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
        return BannedSlugRepository::doesNotHaveSlug($value);
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
