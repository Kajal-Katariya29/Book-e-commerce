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
        Schema::create('variant_types', function (Blueprint $table) {
            $table->bigIncrements('variant_type_id');
            $table->unsignedBigInteger('variant_id');
            $table->foreign('variant_id')->references('variant_id')->on('variants')->onDelete('cascade');
            $table->string('variant_type_name');
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
        Schema::dropIfExists('variant_types');
    }
};
