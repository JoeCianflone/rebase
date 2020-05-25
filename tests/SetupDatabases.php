<?php

namespace Tests;

trait SetupDatabases
{
    protected function setUp(): void
    {
        parent::setUp();

        config(['database.connections.shared' => [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ],
            'database.connections.workspace' => [
                'driver' => 'sqlite',
                'database' => ':memory:',
            ],
        ]);

        $this->artisan('migrate');
    }
}
