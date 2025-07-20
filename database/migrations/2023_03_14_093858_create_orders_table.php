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
            $table->uuid('uuid')->unique();
            $table->string('trx_code')->unique();
            $table->foreignId('user_id');
            $table->foreignId('shop_id');
            $table->foreignId('shipment_id')->nullable();
            $table->text('note')->nullable();
            $table->decimal('total', 15, 2);
            $table->string('shipping_name')->nullable();
            $table->decimal('shipping_price', 15, 2)->nullable();
            $table->dateTime('order_date')->nullable();
            $table->string('shipping_number')->nullable();
            $table->dateTime('shipping_date')->nullable();
            $table->string('state')->nullable();
            $table->string('type')->nullable();
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
