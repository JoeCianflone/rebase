<?php declare(strict_types=1);

namespace App\Domain\Builders\Rebase;

use App\Domain\Builders\Rebase\ModelBuilder;

class WorkspaceBuilder extends ModelBuilder
{
    public function bySlug(string $slug) {
        $this->where('slug', $slug);

        return $this;
    }
}
