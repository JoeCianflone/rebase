<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanlistTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('banlist', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->index();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('Banlist');
    }
}
