<?php

namespace App\Enums\Rebase;

use MyCLabs\Enum\Enum;

/**
 * @method static UserRole SUPER()
 * @method static UserRole OWNER()
 * @method static UserRole ADMIN()
 * @method static UserRole EDITOR()
 * @method static UserRole DESIGNER()
 * @method static UserRole ELEVATED()
 * @method static UserRole MEMBER()
 * @method static UserRole LIMITED_MEMBER()
 * @method static UserRole ACCESS_ONLY()
 *
 * @psalm-immutable
 */
class MemberRoles extends Enum
{
    private const SUPER = 'super';
    private const OWNER = 'owner';
    private const ADMIN = 'admin';
    private const EDITOR = 'editor';
    private const DESIGNER = 'designer';
    private const ELEVATED = 'elevated member';
    private const MEMBER = 'member';
    private const LIMITED_MEMBER = 'limited member';
    private const ACCESS_ONLY = 'access';
}
