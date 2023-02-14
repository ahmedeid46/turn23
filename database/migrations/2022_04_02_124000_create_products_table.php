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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('file')->nullable();
            $table->float('price');
            $table->unsignedBigInteger('sub_cat_id');
            $table->unsignedBigInteger('seller_id');
            $table->foreign('sub_cat_id')->references('id')->on('sub_cats')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('seller_id')->references('id')->on('sellers')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('products');
    }
};
