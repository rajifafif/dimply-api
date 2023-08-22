<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->index();
            $table->string('name');
            $table->text('description')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->string('type')->nullable();
            $table->decimal('original_price', 20, 10)->nullable();
            $table->decimal('discounted_price', 20, 10)->nullable();
            $table->decimal('min_amount', 20, 10)->nullable();
            $table->decimal('max_amount', 20, 10)->nullable();
            $table->decimal('percentage', 10, 7)->nullable();
            $table->decimal('min_purchase_amount', 20, 10)->nullable();
            $table->integer('quota')->nullable();
            $table->text('tnc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
