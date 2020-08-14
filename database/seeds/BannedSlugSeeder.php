<?php

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

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
            'administrators',
            'administrator',
            'admins',
            'mysql',
            'email',
            'mail',
            'porn',
            'horizon',
            'public',
            'master',
            'shared',
            'rebase',
            'workspace',
            'route',
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
