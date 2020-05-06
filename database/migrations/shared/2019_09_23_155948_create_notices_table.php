<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('headline')->nullable();
            $table->text('description');
            $table->set('share_with', ['super', 'owner', 'admin', 'worker', 'elevated', 'member', 'access'])->nullable();
            $table->timestamp('show_at')->nullable();
            $table->timestamp('remove_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('notices');
    }
}
