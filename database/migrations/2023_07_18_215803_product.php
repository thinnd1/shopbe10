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
        Schema::create('products', function(Blueprint $table){
          $table->id();
          $table->string('name');
          $table->unsignedBigInteger('price_unit');
          $table->string('image');
          $table->unsignedBigInteger('quantity');
          $table->unsignedBigInteger('brand_id');
          $table->unsignedBigInteger('category_id');
          $table->unsignedBigInteger('shop_id');
          $table->text('product_description')->nullable();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('products');
    }
};
