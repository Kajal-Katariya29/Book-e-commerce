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
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('shipping_address_id');
            $table->foreign('shipping_address_id')->references('address_id')->on('addresses')->onDelete('cascade');
            $table->unsignedBigInteger('billing_address_id');
            $table->foreign('billing_address_id')->references('address_id')->on('addresses')->onDelete('cascade');
            $table->string('payment_type', 255)->nullable();
            $table->string('payment_status', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
