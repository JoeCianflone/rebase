<?php declare(strict_types=1);

namespace App\Domain\Queries\Rebase;

use App\Enums\Rebase\MemberRoles;
use App\Enums\Rebase\WorkspaceStatus;
use App\Exceptions\UnknownOwnerException;
use App\Exceptions\SlugTokenMismatchException;
use App\Domain\Models\Rebase\Workspace\Workspace;

class WorkspaceQueries extends ModelQueries
{
    public function __construct(Workspace $model)
    {
        parent::__construct($model);
        $this->cacheKey = 'workspace';
    }

    public function allActiveOrPending()
    {
        return $this->model
            ->whereIn('status', [WorkspaceStatus::PENDING(), WorkspaceStatus::ACTIVE()])
            ->get();
    }

    public function getOwnerWithEmail(string $email)
    {
        $found = $this->model->members()
            ->where('email', $email)
            ->whereJsonContains('roles->' . $this->model->id, MemberRoles::OWNER())
            ->first();

        if (is_null($found)) {
            throw new UnknownOwnerException('Member is not an owner');
        }

        return $found;
    }

    public function getMembers(string $workspaceID)
    {
        $this->query = $this->model::with('members')
            ->where('id', $workspaceID)
            ->first()
            ->members();

        return $this;
    }

    public function filterBy($q, $fields)
    {
        if ($q) {
            $this->query->where(function ($query) use ($q, $fields): void {
                $count = 0;
                $query->where($fields[$count], 'LIKE', '%' . $q . '%');
                while (++$count < count($fields)) {
                    $query->orWhere($fields[$count], 'LIKE', '%' . $q . '%');
                }
            });
        }

        return $this;
    }

    public function getAllMembers(string $workspaceID, string $orderBy = 'name')
    {
        return $this->model
            ->with('members')
            ->where('id', $workspaceID)
            ->first()
            ->members()
            ->orderBy($orderBy)
            ->get();
    }

    public function hasSlug(string $slug): bool
    {
        return $this->model->where('slug', '=', $slug)->count() > 0;
    }

    public function getBySlug(string $slug): Workspace
    {
        return $this->cache('getBySlug', fn() => $this->model->where('slug', '=', $slug)->firstOrFail());
    }

    public function getByDomain(string $domain): Workspace
    {
        return $this->cache('getByDomain', fn() => $this->model->where('domain', '=', $domain)->firstOrFail());
    }

    public function matchSlugAndToken(string $token, string $slug)
    {
        $found = $this->model
            ->where('activation_token', $token)
            ->where('slug', $slug)
            ->first();

        if (is_null($found)) {
            throw new SlugTokenMismatchException('Slug and Token Mismatch');
        }

        return $found;
    }

    public function isPending(string $slug): bool
    {
        return $this->statusCheck($slug, WorkspaceStatus::PENDING()->getValue());
    }

    public function isActive(string $slug): bool
    {
        return $this->statusCheck($slug, WorkspaceStatus::ACTIVE()->getValue());
    }

    public function isLocked(string $slug): bool
    {
        return $this->statusCheck($slug, WorkspaceStatus::LOCKED()->getValue());
    }

    public function isArchived(string $slug): bool
    {
        return $this->statusCheck($slug, WorkspaceStatus::ARCHIVED()->getValue());
    }

    public function isRemoved(string $slug): bool
    {
        return $this->statusCheck($slug, WorkspaceStatus::REMOVED()->getValue());
    }


    public function hasBeenOnboarded(string $slug): bool
    {
        return $this->cache('onboarded', fn() => $this->model->where('slug', $slug)->where('status', WorkspaceStatus::ACTIVE())->exists());
    }

    private function statusCheck(string $slug, string $status): bool
    {
        return $this->model->where('slug', $slug)->where('status', $status)->exists();
    }
}
