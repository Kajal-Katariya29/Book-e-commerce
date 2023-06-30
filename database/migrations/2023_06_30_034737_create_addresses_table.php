<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('address_id');
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('email',100);
            $table->string('phone_number',100);
            $table->text('shipping_address');
            $table->string('shipping_country',255);
            $table->string('shipping_city',255);
            $table->string('shipping_state',255);
            $table->integer('shipping_pincode');
            $table->text('billing_address')->nullable();
            $table->string('billing_country',255)->nullable();
            $table->string('billing_city',255)->nullable();
            $table->string('billing_state',255)->nullable();
            $table->integer('billing_pincode')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
