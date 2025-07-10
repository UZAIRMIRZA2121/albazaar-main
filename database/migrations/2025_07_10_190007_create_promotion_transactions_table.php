<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('promotion_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('cart_id')->unique();
            $table->string('tran_ref')->nullable(); // initially null until we get the reference
            $table->unsignedBigInteger('promotion_id');
            $table->json('product_ids'); // multiple products
            $table->date('start_date');
            $table->date('end_date');
            $table->string('promotion_type');
            $table->timestamps();

            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotion_transactions');
    }
};
