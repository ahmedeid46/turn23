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
        Schema::table('customers', function (Blueprint $table) {
            $table->longText('registration_certificate');
            $table->longText('tax_card');
            $table->longText('vat_cert');
            $table->longText('invoice');
            $table->longText('delgation');
            $table->string('phone');
            $table->longText('reference_list');
            //
        });

        Schema::table('sellers', function (Blueprint $table) {
            $table->longText('registration_certificate');
            $table->longText('tax_card');
            $table->longText('vat_cert');
            $table->longText('invoice');
            $table->longText('delgation');
            $table->string('phone');
            $table->longText('reference_list');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_and_seller_tabels', function (Blueprint $table) {
            //
        });
    }
};
