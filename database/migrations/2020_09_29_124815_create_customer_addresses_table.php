<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer_addresses', function (Blueprint $table): void {
            $table->id();
            $table->efficientUuid('customer_id');
            $table->boolean('is_primary')->default(false);
            $table->string('line1');
            $table->string('line2')->nullable();
            $table->string('line3')->nullable();
            $table->string('unit_number')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
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
        Schema::dropIfExists('customer_addresses');
    }
}
