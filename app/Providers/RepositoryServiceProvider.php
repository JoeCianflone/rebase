<?php

namespace App\Providers;

use App\Domain\Models\Member;
use App\Domain\Models\Customer;
use App\Domain\Models\Workspace;
use App\Domain\Models\BannedSlug;
use App\Domain\Models\MemberWorkspace;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\EloquentMemberRepository;
use App\Domain\Repositories\EloquentCustomerRepository;
use App\Domain\Repositories\EloquentWorkspaceRepository;
use App\Domain\Repositories\EloquentBannedSlugRepository;
use App\Domain\Repositories\EloquentMemberWorkspaceRepository;

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

        // $this->app->singleton('MemberWorkspaceRepository', function (Application $app) {
        //     return new EloquentMemberWorkspaceRepository(new MemberWorkspace());
        // });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
