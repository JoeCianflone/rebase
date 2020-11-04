<?php

namespace App\Enums\Rebase;

use MyCLabs\Enum\Enum;

/**
 * @method static CustomerStatus ACTIVE()
 * @method static CustomerStatus PENDING()
 * @method static CustomerStatus INACTIVE()
 * @method static CustomerStatus VERIFIED()
 * @method static CustomerStatus LOCKED()
 * @method static CustomerStatus REMOVED()
 * @method static CustomerStatus ARCHIVED()
 *
 * @psalm-immutable
 */
class WorkspaceStatus extends Enum
{
    private const ACTIVE = 'active';
    private const PENDING = 'pending';
    private const INACTIVE = 'inactive';
    private const VERIFIED = 'verfied';
    private const LOCKED = 'locked';
    private const REMOVED = 'removed';
    private const ARCHIVED = 'archived';
}
