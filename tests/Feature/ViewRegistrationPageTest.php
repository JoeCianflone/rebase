<?php

namespace Tests\Feature;

use Tests\SetupDatabases;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class ViewRegistrationPageTest extends TestCase
{
    use SetupDatabases;

    /** @test */
    public function userCanViewRegistationPage()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }
}
