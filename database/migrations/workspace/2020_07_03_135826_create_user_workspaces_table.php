<?php

use App\Enums\MemberRole;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberWorkspacesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('member_workspaces', function (Blueprint $table): void {
            $table->efficientUuid('id')->primary();
            $table->efficientUuid('customer_id');
            $table->efficientUuid('member_id');
            $table->efficientUuid('customer_workspace_id');
            $table->enum('role', Arr::flatten(MemberRole::toArray()))->default(MemberRole::MEMBER());
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')
                ->on(config('app-paths.db.shared.name').'.accounts')
                ->onDelete('cascade');

            $table->foreign('member_id')
                ->references('id')
                ->on(config('app-paths.db.workspace.name').'.members')
                ->onDelete('cascade');

            $table->foreign('customer_workspace_id')
                ->references('id')
                ->on(config('app-paths.db.shared.name').'.customer_workspaces')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('member_workspaces', function (Blueprint $table): void {
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['member_id']);
            $table->dropForeign(['customer_workspace_id']);
        });

        Schema::dropIfExists('member_workspace');
    }
}
