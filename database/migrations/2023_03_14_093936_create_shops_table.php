<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id');
            $table->string('name')->unique();
            $table->string('slug')->nullable()->unique();
            $table->string('supplier_name')->nullable();
            $table->string('invitation_code')->nullable();
            $table->longText('description')->nullable();
            $table->string('phone_number');
            $table->string('contact_person');
            $table->string('id_card');
            $table->longText('address');
            $table->foreignId('merchant_id')->nullable();
            $table->foreignId('payment_method_id')->nullable();
            $table->longText('profile_picture')->nullable();
            $table->longText('business_license')->nullable();
            $table->string('type')->nullable();
            $table->string('state')->nullable();
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
        Schema::dropIfExists('shops');
    }
}
