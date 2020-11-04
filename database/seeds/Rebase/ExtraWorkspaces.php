<?php

namespace Database\Seeders\Rebase;

use Illuminate\Support\Arr;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Enums\Rebase\MemberRoles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use App\Domain\Facades\Rebase\MemberRepository;
use App\Domain\Facades\Rebase\CustomerRepository;
use App\Domain\Facades\Rebase\WorkspaceRepository;

class ExtraWorkspaces extends Seeder
{
    const CUSTOMERS = 2;
    const WORKSPACES_PER_CUSTOMER = 3;
    const MEMBERS_PER_WORKSPACE = 10;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = new Faker();
        $faker->addProvider(new \Faker\Provider\en_US\Person($faker));
        $faker->addProvider(new \Faker\Provider\en_US\Address($faker));
        $faker->addProvider(new \Faker\Provider\en_US\PhoneNumber($faker));
        $faker->addProvider(new \Faker\Provider\en_US\Company($faker));
        $faker->addProvider(new \Faker\Provider\Lorem($faker));
        $faker->addProvider(new \Faker\Provider\Internet($faker));

        for ($i = 0; $i < self::CUSTOMERS; ++$i) {
            $customer = CustomerRepository::factory()->create([
                'name' => $faker->company,
                'line1' => $faker->streetAddress,
                'city' => $faker->city,
                'state' => $faker->stateAbbr,
                'postal_code' => $faker->postcode,
                'country' => $faker->country,
                'agreed_to_terms' => true,
                'agreed_to_privacy' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            for ($j = 0; $j < self::WORKSPACES_PER_CUSTOMER; ++$j) {
                $code = Artisan::call('migrate:workspaces', [
                    'customerID' => $customer->id,
                    '--rebase' => true,
                ]);

                $workspace = WorkspaceRepository::factory()->create([
                    'customer_id' => $customer->id,
                    'name' => $faker->company,
                    'slug' => $faker->slug(2),
                ]);

                for ($k = 0; $k < self::MEMBERS_PER_WORKSPACE; ++$k) {
                    $member = MemberRepository::factory()->create([
                        'name' => $faker->name,
                        'email' => $faker->safeEmail,
                        'password' => Hash::make('password'),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                    MemberRepository::factory($member)->attachToWorkspaceAs($workspace->id, $this->generateRandomRole());
                }
            }
        }
    }

    private function generateRandomRole()
    {
        $key = Arr::flatten(MemberRoles::keys())[rand(1, 8)];

        return MemberRoles::$key();
    }
}
