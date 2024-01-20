<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('product_id')->unsigned()->index();
            $table->bigInteger('shop_id')->unsigned()->index();
            $table->string('shipping_method', 60)->default('default');
            $table->integer('price')->nullable();
            $table->string('status', 120)->default('pending');
            $table->decimal('amount', 15);
            $table->text('description')->nullable();
            $table->boolean('is_confirmed')->default(false);
            $table->boolean('is_finished')->default(1)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
