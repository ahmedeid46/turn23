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
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on("customers")->onDelete('cascade');
            $table->unsignedBigInteger('order_id'); # FROM THE PREVIOUS TABLE
            $table->foreign('order_id')->references('id')->on("orders")->onDelete('cascade');
            $table->string('type')->default('RECHARGE');  #RECHARGE,REFUND,WITHDRAW,..etc
            $table->string('status'); #PENDING,CANCELED,DONE
            $table->float('amount')->default(0);
            $table->string('source')->nullable(); #PAYMENT GATEWAY LIKE : PAYPAL,KASHIER,PAYMOB,FAWRY,..etc
            $table->string('payment_id')->nullable(); #UNIQUE ID YOU CAN GENERATE ONE , SOMETIMES RETURNED FROM GATEWAY TO TRACE YOUR PAYMENT
            $table->json('process_data')->nullable(); #THE RESPONSE OF SERVER OF GATEWAY
            $table->text('description')->nullable();
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
        Schema::dropIfExists('payments');
    }
};
