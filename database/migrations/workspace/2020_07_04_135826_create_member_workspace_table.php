<?php

use Illuminate\Support\Arr;
use App\Enums\Rebase\MemberRoles;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberWorkspaceTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('member_workspace', function (Blueprint $table): void {
            $table->id();
            $table->uuid('member_id');
            $table->uuid('workspace_id');
            $table->enum('role', Arr::flatten(MemberRoles::toArray()))->default(MemberRoles::MEMBER());
            $table->timestamps();

            $table->foreign('member_id')
                ->references('id')
                ->on('members')
                ->onDelete('cascade');

            $table->foreign('workspace_id')
                ->references('id')
                ->on('workspaces')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('member_workspace', function (Blueprint $table): void {
            $table->dropForeign(['member_id']);
            $table->dropForeign(['workspace_id']);
        });

        Schema::dropIfExists('member_workspace');
    }
}
