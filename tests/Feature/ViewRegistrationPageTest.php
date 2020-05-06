<?php

namespace Tests\Feature;

use Tests\SetupDatabases;
use Tests\TestCase;

class ViewRegistrationPageTest extends TestCase
{
    use SetupDatabases;

    /** @test */
    public function user_can_view_registation_page()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }
}
