<?php

declare(strict_types=1);

namespace App\Http\Controllers\Shared\Register;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller as BaseController;
use App\Domain\Repositories\Facades\BannedSlugRepository;

class ProcessRegisterWorkspace extends BaseController
{
    /**
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'slug' => ['required', 'unique:workspaces,slug', function ($attribute, $value, $fail): void {
                if (BannedSlugRepository::hasSlug($value)) {
                    $fail("{$value} is not a valid {$attribute}");
                }
            }],
        ]);

        return Redirect::route('view.register.user')->with([
            'slug' => $request->input('slug'),
        ]);
    }
}
