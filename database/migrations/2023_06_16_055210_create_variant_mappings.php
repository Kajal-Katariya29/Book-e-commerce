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
        Schema::create('variant_mappings', function (Blueprint $table) {
            $table->bigIncrements('variant_mapping_id');
            $table->unsignedBigInteger('variant_id');
            $table->foreign('variant_id')->references('variant_id')->on('variants')->onDelete('cascade');
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('book_id')->on('book_lists')->onDelete('cascade');
            $table->unsignedBigInteger('variant_type_id');
            $table->foreign('variant_type_id')->references('variant_type_id')->on('variant_types')->onDelete('cascade');
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
        Schema::dropIfExists('variant_mappings');
    }
};
