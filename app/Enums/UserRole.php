<?php
namespace App\Enums;

use MyCLabs\Enum\Enum;

/**
 * @method static UserRole SUPER()
 * @method static UserRole OWNER()
 * @method static UserRole ADMIN()
 * @method static UserRole WORKER()
 * @method static UserRole ELEVATED()
 * @method static UserRole MEMBER()
 * @method static UserRole ACCESS()
 */
class UserRole extends Enum
{
    private const SUPER    = 'super';
    private const OWNER    = 'owner';
    private const ADMIN    = 'admin';
    private const WORKER   = 'worker';
    private const ELEVATED = 'elevated';
    private const MEMBER   = 'member';
    private const ACCESS   = 'access';
}
