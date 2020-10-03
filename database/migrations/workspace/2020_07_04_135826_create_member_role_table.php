<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberRoleTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('member_role', function (Blueprint $table): void {
            $table->id();
            $table->uuid('member_id');
            $table->unsignedBigInteger('role_id');
            $table->uuid('workspace_id');
            $table->timestamps();

            $table->foreign('member_id')
                ->references('id')
                ->on(config('app-paths.db.workspace.name').'.members')
                ->onDelete('cascade');

            $table->foreign('workspace_id')
                ->references('id')
                ->on(config('app-paths.db.shared.name').'.workspaces')
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on(config('app-paths.db.workspace.name').'.roles')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('member_role', function (Blueprint $table): void {
            $table->dropForeign(['member_id']);
            $table->dropForeign(['workspace_id']);
            $table->dropForeign(['role_id']);
        });

        Schema::dropIfExists('member_role');
    }
}
