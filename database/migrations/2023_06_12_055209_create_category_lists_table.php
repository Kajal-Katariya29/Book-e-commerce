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
        Schema::create('category_lists', function (Blueprint $table) {
            $table->bigIncrements('cateogery_id');
            $table->integer('category_parent_id')->nullable();
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('book_id')->on('book_lists')->onDelete('cascade');
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
        Schema::dropIfExists('category_lists');
    }
};
