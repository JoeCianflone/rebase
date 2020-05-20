<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionItemsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscription_items', function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('subscription_id');
            $table->string('stripe_id')->index();
            $table->string('stripe_plan');
            $table->integer('quantity');
            $table->timestamps();

            $table->unique(['subscription_id', 'stripe_plan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_items');
    }
}
