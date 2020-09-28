<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

/**
 * @method static CustomerStatus ACTIVE()
 * @method static CustomerStatus INACTIVE()
 * @method static CustomerStatus LOCKED()
 * @method static CustomerStatus CLOSED()
 * @method static CustomerStatus PENDING()
 * @method static CustomerStatus REVIEW_REQUIRED()
 * @method static CustomerStatus BANNED()
 *
 * @psalm-immutable
 */
class CustomerStatus extends Enum
{
    private const ACTIVE = 'active';
    private const INACTIVE = 'inactive';
    private const LOCKED = 'locked';
    private const CLOSED = 'closed';
    private const PENDING = 'pending';
    private const REVIEW_REQUIRED = 'review';
    private const BANNED = 'banned';
}
