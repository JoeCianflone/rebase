<?php

use Tests\TestCase;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Set the currently logged in user for the application.
 */
function actingAs(Authenticatable $user, string $driver = null): TestCase
{
    return test()->actingAs($user, $driver);
}
