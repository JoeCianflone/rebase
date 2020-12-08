<?php

namespace App\Providers;

use App\Domain\Models\Rebase\Workspace\Role;
use App\Domain\Repositories\Rebase\EloquentRoleRepository;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use App\Domain\Models\Rebase\Admin\Lookup;
use App\Domain\Models\Rebase\Workspace\Member;
use App\Domain\Models\Rebase\Admin\Customer;
use App\Domain\Models\Rebase\Admin\BannedSlug;
use App\Domain\Models\Rebase\Workspace\Workspace;
use Illuminate\Contracts\Support\DeferrableProvider;
use App\Domain\Repositories\Rebase\EloquentLookupRepository;
use App\Domain\Repositories\Rebase\EloquentMemberRepository;
use App\Domain\Repositories\Rebase\EloquentCustomerRepository;
use App\Domain\Repositories\Rebase\EloquentWorkspaceRepository;
use App\Domain\Repositories\Rebase\EloquentBannedSlugRepository;

class RepositoryServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('CustomerRepository', function (Application $app) {
            return new EloquentCustomerRepository(new Customer());
        });

        $this->app->bind('WorkspaceRepository', function (Application $app) {
            return new EloquentWorkspaceRepository(new Workspace());
        });

        $this->app->bind('MemberRepository', function (Application $app) {
            return new EloquentMemberRepository(new Member());
        });

        $this->app->bind('BannedSlugRepository', function (Application $app) {
            return new EloquentBannedSlugRepository(new BannedSlug());
        });

        $this->app->bind('LookupRepository', function (Application $app) {
            return new EloquentLookupRepository(new Lookup());
        });

        $this->app->bind('RoleRepository', function (Application $app) {
            return new EloquentRoleRepository(new Role());
        });
    }

    public function provides(): array
    {
        return ['LookupRepository', 'BannedSlugRepository', 'MemberRepository', 'WorkspaceRepository', 'CustomerRepository', 'RoleRepository'];
    }
}
