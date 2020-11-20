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

class PersonalWorkspace extends Seeder
{
    const MEMBERS_PER_WORKSPACE = 10;
    const WORKSPACES = 2;
    const PERSONAL_NAME = 'Joe Cianflone';
    const PERSONAL_EMAIL = 'joe@cianflone.co';
    const PERSONAL_PASSWORD = 'password123';
    const PERSONAL_SLUG = 'joecianflone';

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

        $customer = CustomerRepository::factory()->create([
            'name' => 'Personal Test Company',
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

        $code = Artisan::call('migrate:workspaces', [
            'customerID' => $customer->id,
            '--rebase' => true,
        ]);

        if ($code === 0) {
            $member = MemberRepository::factory()->create([
                'name' => self::PERSONAL_NAME,
                'email' => self::PERSONAL_EMAIL,
                'password' => Hash::make(self::PERSONAL_PASSWORD),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            for ($i = 0; $i <= self::WORKSPACES; ++$i) {
                $slug = self::PERSONAL_SLUG.'-'.$i;
                if ($i == 0) {
                    $slug = self::PERSONAL_SLUG;
                }
                $workspace = WorkspaceRepository::factory()->create([
                    'customer_id' => $customer->id,
                    'name' => 'Personal Test Workspace '.$i,
                    'slug' => $slug,
                ]);

                MemberRepository::factory($member)->update([
                    'roles->'.$workspace->id => MemberRoles::OWNER(),
                ]);
                MemberRepository::factory($member)->attachToWorkspace($workspace->id);

                for ($k = 0; $k < self::MEMBERS_PER_WORKSPACE; ++$k) {
                    $otherMembers = MemberRepository::factory()->create([
                        'name' => $faker->name,
                        'email' => $faker->safeEmail,
                        'password' => Hash::make(self::PERSONAL_PASSWORD),
                        'roles->'.$workspace->id => $this->generateRandomRole(),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);

                    MemberRepository::factory($otherMembers)->attachToWorkspace($workspace->id);
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
