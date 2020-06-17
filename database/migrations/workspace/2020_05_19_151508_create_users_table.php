<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('avatar')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->json('profile')->nullable();

            $table->timestamps();

            // $table->foreign('workspace_id')
            //     ->references('id')
            //     ->on(config('multi-database.shared.name').'.workspaces')
            //     ->onDelete('cascade')
            // ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropForeign(['workspace_id']);
        });

        Schema::dropIfExists('users');
    }
}
