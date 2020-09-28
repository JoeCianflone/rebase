<?php

namespace Database\Seeders;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannedSlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('banned_slugs')->insert($this->slug([
            'admin',
            'super',
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
        ]));
    }

    private function slug(array $slugs): array
    {
        $collection = collect($slugs)->map(function ($slug) {
            return [
                'id' => Uuid::uuid4()->toString(),
                'slug' => $slug,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
        });

        return $collection->toArray();
    }
}
