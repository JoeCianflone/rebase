<?php

use App\Enums\UserRole;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserWorkspaceTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_workspace', function (Blueprint $table): void {
            $table->id();
            $table->uuid('user_id');
            $table->uuid('workspace_id');
            $table->enum('role', Arr::flatten(UserRole::toArray()));
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on(config('multi-database.workspace.name').'.users')
                ->onDelete('cascade')
            ;

            $table->foreign('workspace_id')
                ->references('id')
                ->on(config('multi-database.shared.name').'.workspaces')
                ->onDelete('cascade')
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_workspace');
    }
}
