<?php

use Illuminate\Support\Arr;
use App\Enums\WorkspaceStatus;
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
            $table->efficientUuid('id')->primary();
            $table->efficientUuid('customer_id');
            $table->string('name');
            $table->string('slug')->index();
            $table->string('domain')->index()->nullable();
            $table->enum('status', Arr::flatten(WorkspaceStatus::toArray()))->default(WorkspaceStatus::INACTIVE());
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_workspaces', function (Blueprint $table): void {
            $table->dropForeign(['customer_id']);
        });

        Schema::dropIfExists('customer_workspaces');
    }
}
