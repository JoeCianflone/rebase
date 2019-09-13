<?php
namespace App\Domain\Services\Users\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class IndexUserController
{

    public function __invoke(Request $request)
    {
        return Inertia::render("{{inertia_path}}");
    }
}