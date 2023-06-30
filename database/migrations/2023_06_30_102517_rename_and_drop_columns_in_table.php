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
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('billing_address');
            $table->dropColumn('billing_country');
            $table->dropColumn('billing_city');
            $table->dropColumn('billing_pincode');
            $table->dropColumn('billing_state');
            $table->renameColumn('shipping_address', 'address');
            $table->renameColumn('shipping_country', 'country');
            $table->renameColumn('shipping_city', 'city');
            $table->renameColumn('shipping_state', 'state');
            $table->renameColumn('shipping_pincode', 'pincode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            //
        });
    }
};
