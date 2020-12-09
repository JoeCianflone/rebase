<?php

namespace Database\Seeders\Rebase;

use Exception;
use Faker\Provider\en_US\Address;
use Faker\Provider\en_US\Company;
use Faker\Provider\en_US\Person;
use Faker\Provider\en_US\PhoneNumber;
use Faker\Provider\Internet;
use Faker\Provider\Lorem;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Enums\Rebase\MemberRoles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use App\Domain\Facades\Rebase\RoleRepository;
use App\Domain\Facades\Rebase\MemberRepository;
use App\Domain\Facades\Rebase\CustomerRepository;
use App\Domain\Facades\Rebase\WorkspaceRepository;
use Illuminate\Support\Str;

class PersonalWorkspace extends Seeder
{
    public const MEMBERS_PER_WORKSPACE = 100;
    public const WORKSPACES = 2;
    public const PERSONAL_NAME = 'Joe Cianflone';
    public const PERSONAL_EMAIL = 'joe@cianflone.co';
    public const PERSONAL_PASSWORD = 'password123';
    public const PERSONAL_SLUG = 'joecianflone';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = new Faker();
        $faker->addProvider(new Person($faker));
        $faker->addProvider(new Address($faker));
        $faker->addProvider(new PhoneNumber($faker));
        $faker->addProvider(new Company($faker));
        $faker->addProvider(new Lorem($faker));
        $faker->addProvider(new Internet($faker));

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
            RoleRepository::factory()->addAccountOwner($member->id);

            for ($i = 1; $i <= self::WORKSPACES; $i++) {
                $slug = $i === 1 ? self::PERSONAL_SLUG : self::PERSONAL_SLUG.'-'.$i;

                $workspace = WorkspaceRepository::factory()->create([
                    'customer_id' => $customer->id,
                    'name' => 'Personal Test Workspace '.$i,
                    'slug' => $slug,
                ]);

                MemberRepository::factory($member)->attachToWorkspace($workspace->id);

                for ($k = 1; $k <= self::MEMBERS_PER_WORKSPACE; $k++) {
                    $otherMembers = MemberRepository::factory()->create([
                        'name' => $faker->name,
                        'email' => $faker->unique()->safeEmail,
                        'password' => Hash::make(self::PERSONAL_PASSWORD),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);

                    RoleRepository::factory()->addWorkspaceRole($this->generateRandomRole(), $workspace->id,  $otherMembers->id);
                    MemberRepository::factory($otherMembers)->attachToWorkspace($workspace->id);
                }
            }
        }
    }

    private function generateRandomRole(): string
    {
        try {
            $key = Arr::flatten(MemberRoles::keys())[random_int(3, 9)];
        } catch (Exception $e) {
            echo $e->getMessage();

            die();
        }


        return MemberRoles::$key();
    }
}
