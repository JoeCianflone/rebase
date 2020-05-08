<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\SetupDatabases;

/**
 * @internal
 * @coversNothing
 */
class ViewRegistrationPageTest extends TestCase
{
    use SetupDatabases;

    /**
     * @test
     */
    public function userCanViewRegistationPage(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }
}
