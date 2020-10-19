<?php

namespace App\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use App\Domain\Models\Rebase\Customer\Lookup;
use App\Domain\Models\Rebase\Workspace\Member;
use App\Domain\Models\Rebase\Customer\Customer;
use App\Domain\Models\Rebase\Customer\BannedSlug;
use App\Domain\Models\Rebase\Workspace\Workspace;
use App\Domain\Repositories\Rebase\EloquentLookupRepository;
use App\Domain\Repositories\Rebase\EloquentMemberRepository;
use App\Domain\Repositories\Rebase\EloquentCustomerRepository;
use App\Domain\Repositories\Rebase\EloquentWorkspaceRepository;
use App\Domain\Repositories\Rebase\EloquentBannedSlugRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('CustomerRepository', function (Application $app) {
            return new EloquentCustomerRepository(new Customer());
        });

        $this->app->singleton('WorkspaceRepository', function (Application $app) {
            return new EloquentWorkspaceRepository(new Workspace());
        });

        $this->app->singleton('MemberRepository', function (Application $app) {
            return new EloquentMemberRepository(new Member());
        });

        $this->app->singleton('BannedSlugRepository', function (Application $app) {
            return new EloquentBannedSlugRepository(new BannedSlug());
        });

        $this->app->singleton('LookupRepository', function (Application $app) {
            return new EloquentLookupRepository(new Lookup());
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
