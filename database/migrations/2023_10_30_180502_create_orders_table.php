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
            $table->string('shipping_option', 60)->nullable();
            $table->string('shipping_method', 60)->default('default');
            $table->string('status', 120)->default('pending');
            $table->decimal('amount', 15);
            $table->bigInteger('currency_id')->unsigned()->index()->nullable();
            $table->decimal('shipping_amount')->nullable();
            $table->text('description')->nullable();
            $table->string('coupon_code', 120)->nullable();
            $table->decimal('discount_amount', 15)->nullable();
            $table->decimal('sub_total', 15)->nullable();
            $table->boolean('is_confirmed')->default(false);
            $table->string('discount_description', 255)->nullable();
            $table->boolean('is_finished')->default(1)->nullable();
            $table->bigInteger('payment_id')->unsigned()->nullable()->index();

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
