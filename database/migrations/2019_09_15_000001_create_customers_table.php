<?php

use Illuminate\Support\Arr;
use App\Enums\CustomerStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table): void {
            $table->efficientUuid('id')->primary();
            $table->string('name');
            $table->enum('status', Arr::flatten(CustomerStatus::toArray()))->default(CustomerStatus::PENDING());
            $table->timestamp('agrees_to_terms_at')->nullable();
            $table->timestamp('agrees_to_privacy_at')->nullable();

            $table->string('stripe_id')->nullable()->index();
            $table->string('card_brand')->nullable();
            $table->string('card_last_four', 4)->nullable();
            $table->timestamp('trial_ends_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
}