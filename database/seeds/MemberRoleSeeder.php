<?php

namespace Database\Seeders;

use App\Enums\MemberRoles;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(collect(Arr::flatten(MemberRoles::toArray()))->map(function($name) {
            return [
                'name' => $name
            ];
        })->toArray());
    }
}
