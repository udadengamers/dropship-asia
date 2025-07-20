<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentBuyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_buyers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('trx_code')->unique();
            $table->foreignId('user_id');
            $table->foreignId('order_id');
            $table->decimal('amount_submitted', 15, 2);
            $table->string('bank_name');
            $table->string('bank_account_name');
            $table->string('bank_account_number');
            $table->string('proof_file_path')->nullable();
            $table->text('remarks')->nullable();
            $table->foreignId('approved_by_id')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->dateTime('paid_at')->nullable();
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
        Schema::dropIfExists('payment_buyers');
    }
}
