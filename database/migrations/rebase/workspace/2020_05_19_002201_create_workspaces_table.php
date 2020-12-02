<?php

use Illuminate\Support\Arr;
use App\Enums\Rebase\WorkspaceStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkspacesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workspaces', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->uuid('customer_id');
            $table->string('name');
            $table->string('slug')->unique()->index();
            $table->string('domain')->unique()->index()->nullable();
            $table->enum('status', Arr::flatten(WorkspaceStatus::toArray()))->default(WorkspaceStatus::PENDING());
            $table->integer('active_users')->default(0);
            $table->integer('total_users')->default(0);
            $table->uuid('activation_token')->nullable();
            $table->dateTime('activation_at')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')
                ->on(config('rebase.paths.db.shared.name').'.customers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workspaces', function (Blueprint $table): void {
            $table->dropForeign(['customer_id']);
        });

        Schema::dropIfExists('workspaces');
    }
}
