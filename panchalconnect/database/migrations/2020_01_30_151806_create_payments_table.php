<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
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
            $table->unsignedBigInteger('PROFILE_ID');
            $table->string('ORDERID')->nullable();
            $table->string('MID')->nullable();
            $table->string('TXNID')->nullable();
            $table->integer('TXNAMOUNT')->nullable();
            $table->string('PAYMENTMODE')->nullable();
            $table->string('CURRENCY')->nullable();
            $table->string('TXNDATE')->nullable();
            $table->string('STATUS')->nullable();
            $table->string('RESPCODE')->nullable();
            $table->string('RESPMSG')->nullable();
            $table->string('GATEWAYNAME')->nullable();
            $table->string('BANKTXNID')->nullable();
            $table->string('BANKNAME')->nullable();
            $table->string('CHECKSUMHASH')->nullable();
            $table->string('SOURCE');
            $table->date('START_DATE');
            $table->date('END_DATE');
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
}
