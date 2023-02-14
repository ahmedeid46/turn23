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
        Schema::table('products', function (Blueprint $table) {
            $table->string('qty');
            $table->string('packing');
            $table->string('sample');
            $table->string('ProductionData');
            $table->string('expirationDate');
            $table->string('length');
            $table->string('in_out');
            $table->string('sch');
            $table->string('pressure');
            $table->string('size');
            $table->string('brand');
            $table->string('class');
            $table->string('moc');
            $table->string('material');
            $table->string('grade');
            $table->string('website');
            $table->string('flowrate');
            $table->longText('content');
            $table->longText('mods');
            $table->longText('tds');
            $table->longText('coa');
            $table->longText('docs');
            $table->longText('cover');
            $table->longText('photos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_tabel', function (Blueprint $table) {
            //
        });
    }
};
