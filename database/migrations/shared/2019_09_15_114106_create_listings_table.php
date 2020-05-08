<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->uuid('account_id');
            $table->uuid('workspace_id')->index()->unique();
            $table->string('slug')->index()->unique();
            $table->string('domain')->nullable()->index()->unique();
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onCascade('delete')
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
}
