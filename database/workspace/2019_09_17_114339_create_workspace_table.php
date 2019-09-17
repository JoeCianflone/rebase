<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkspaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workspace', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('account_id');
            $table->string('slug')->unique()->index();

            $table->foreign('workspace_id')
                  ->references('id')
                  ->on('workspaces')
                  ->onCascade('delete');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workspace');
    }
}
