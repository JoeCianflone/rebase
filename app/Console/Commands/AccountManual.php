<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use App\Helpers\DBWorkspace;
use Illuminate\Console\Command;
use App\Events\NewAccountCreated;
use Illuminate\Support\Facades\Hash;
use App\Helpers\WorkspaceConnectionManager;
use App\Domain\Repositories\Facades\UserRepository;
use App\Domain\Repositories\Facades\AccountRepository;
use App\Domain\Repositories\Facades\WorkspaceRepository;

class AccountManual extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manually create an account and spin up a new DB without going through the reg process';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        if ('local' !== app()->environment()) {
            $this->error('This command only runs in local environments, it is for messing around pre-ui only.');
            exit();
        }

        $accountName = $this->ask('Account Name (required)');
        $slug = $this->ask('Slug (required)');

        $line1 = $this->ask('Address Line 1 (required)');
        $line2 = $this->ask('Address Line 2');
        $line3 = $this->ask('Address Line 3');
        $unitNumber = $this->ask('Unit Number');

        $locality = $this->ask('City (required)');
        $state = $this->ask('State (required)');
        $postalCode = $this->ask('Postal Code (required)');
        $country = $this->ask('Country (required)', 'USA');

        $name = $this->ask('Account Owners Name (required)');
        $email = $this->ask('Account Owners Email Address (required)');
        $password = $this->secret('Account Owners Password (required)');

        if ($this->hasMissingFields($accountName, $line1, $locality, $state, $postalCode, $country, $name, $email, $password)) {
            $this->error('All required fields are...required');
            die();
        }

        if (WorkspaceRepository::hasSlug($slug)) {
            $this->error('Slug Exists, cannot create listing');
            die();
        }

        $accountID = Str::uuid()->toString();
        $workspaceID = $this->spinUpWorkspace($accountID);

        $account = AccountRepository::create([
            'id' => $accountID,
            'name' => $accountName,
            'address_line1' => $line1,
            'address_line2' => $line2,
            'address_line3' => $line3,
            'city' => $locality,
            'state' => $state,
            'postal_code' => $postalCode,
            'country' => $country,
        ]);

        $workspace = WorkspaceRepository::create([
            'id' => $workspaceID,
            'account_id' => $account->id,
            'name' => $accountName,
            'slug' => $slug,
        ]);

        $user = UserRepository::create([
            'id' => Str::uuid()->toString(),
            'workspace_id' => $workspace->id,
            'first_name' => explode(' ', $name)[0],
            'last_name' => explode(' ', $name)[1],
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        event(new NewAccountCreated($workspace, $user));
    }

    private function spinUpWorkspace(string $accountID): string
    {
        $newWorkspaceID = Str::uuid()->toString();

        DBWorkspace::create($accountID);

        WorkspaceConnectionManager::disconnect();
        WorkspaceConnectionManager::connect($newWorkspaceID);

        $this->call('migrate', [
            '--database' => config('multi-database.workspace.connection'),
            '--path' => config('multi-database.workspace.migration_path'),
            '--step' => true,
            '--force' => true,
            '--no-interaction' => true,
        ]);

        return $newWorkspaceID;
    }

    private function hasMissingFields(?string ...$fields): bool
    {
        foreach ($fields as $field) {
            if (is_null($field)) {
                return true;
            }
        }

        return false;
    }
}
