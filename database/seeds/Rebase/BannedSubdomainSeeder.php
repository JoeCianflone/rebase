<?php

namespace Database\Seeders\Rebase;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannedSubdomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('banned_subdomains')->insert($this->subdomains([
            'admin',
            'my',
            'super',
            'auth',
            'superadmin',
            'super-admin',
            'administrators',
            'administrator',
            'admins',
            'mysql',
            'email',
            'mail',
            'horizon',
            'public',
            'master',
            'shared',
            'rebase',
            'workspace',
            'route',
            'register',
            'help',
            'becker',
            'default',
            'demo',
            'test',
            'demo-test',
            'database',
            'info',
            'primary',
            'delete',
            'rm-rf',
            'appspace',
        ]));
    }

    private function subdomains(array $subs): array
    {
        return collect($subs)->map(function ($sub) {
            return [
                'sub' => $sub,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
        })->toArray();
    }
}
