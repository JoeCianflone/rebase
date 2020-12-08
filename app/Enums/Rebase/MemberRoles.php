<?php

namespace App\Enums\Rebase;

use MyCLabs\Enum\Enum;

/**
 * @method static MemberRoles SUPER()
 * @method static MemberRoles ACCOUNT_OWNER()
 * @method static MemberRoles ACCOUNT_ADMIN()
 * @method static MemberRoles WORKSPACE_OWNER()
 * @method static MemberRoles WORKSPACE_ADMIN()
 * @method static MemberRoles EDITOR()
 * @method static MemberRoles ELEVATED()
 * @method static MemberRoles MEMBER()
 * @method static MemberRoles LIMITED()
 * @method static MemberRoles ACCESS_ONLY()
 *
 * @psalm-immutable
 */
class MemberRoles extends Enum
{
    private const SUPER = 'super';
    private const ACCOUNT_OWNER = 'account_owner';
    private const ACCOUNT_ADMIN = 'account_admin';
    private const WORKSPACE_OWNER = 'workspace_owner';
    private const WORKSPACE_ADMIN = 'workspace_admin';
    private const EDITOR = 'editor';
    private const ELEVATED = 'elevated';
    private const MEMBER = 'member';
    private const LIMITED = 'limited';
    private const ACCESS_ONLY = 'access';
}
