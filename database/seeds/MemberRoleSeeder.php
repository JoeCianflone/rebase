<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Enums\MemberRoles;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert(collect(Arr::flatten(MemberRoles::toArray()))->map(function ($name) {
            return [
                'name' => $name,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
        })->toArray());
    }
}
