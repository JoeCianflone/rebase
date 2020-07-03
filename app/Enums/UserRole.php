<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

/**
 * @method static UserRole SUPER()
 * @method static UserRole ACCOUNT_OWNER()
 * @method static UserRole ACCOUNT_ADMIN()
 * @method static UserRole WORKSPACE_ADMIN()
 * @method static UserRole WORKSPACE_EDITOR()
 * @method static UserRole WORKSPACE_DESIGNER()
 * @method static UserRole WORKSPACE_ELEVATED()
 * @method static UserRole WORKSPACE_MEMBER()
 * @method static UserRole WORKSPACE_LIMITED_MEMBER()
 * @method static UserRole WORKSPACE_ACCESS_ONLY()
 */
class UserRole extends Enum
{
    private const SUPER = 'super';
    private const ACCOUNT_OWNER = 'account_owner';
    private const ACCOUNT_ADMIN = 'account_admin';
    private const WORKSPACE_ADMIN = 'workspace_admin';
    private const WORKSPACE_EDITOR = 'workspace_editor';
    private const WORKSPACE_DESIGNER = 'workspace_designer';
    private const WORKSPACE_ELEVATED = 'workspace_elevated_member';
    private const WORKSPACE_MEMBER = 'workspace_member';
    private const WORKSPACE_LIMITED_MEMBER = 'workspace_limited_member';
    private const WORKSPACE_ACCESS_ONLY = 'workspace_access';
}
