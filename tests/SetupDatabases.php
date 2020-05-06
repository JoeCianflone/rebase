<?php

namespace Tests;

trait SetupDatabases
{
    protected function setUp(): void
    {
        parent::setUp();

        config(['database.connections.shared' => [
            'driver' => 'sqllite',
            'database' => ':memory:'
        ],
            'database.connections.workspace' => [
                'driver' => 'sqllite',
                'database' => ':memory:'
            ]
        ]);

        $this->artisan('migrate');
    }
}
