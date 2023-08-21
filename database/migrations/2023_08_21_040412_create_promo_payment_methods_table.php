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
        Schema::create('promo_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('promo_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->timestamps();

            $table->index(['promo_id', 'payment_method_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_payment_methods');
    }
};
