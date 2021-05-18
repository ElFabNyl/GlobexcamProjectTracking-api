<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phase');
            $table->unsignedBigInteger('amount_payed');
            $table->enum('method_payment',['ORANGE MONEY','MTN MONEY','CASH']);
            $table->unsignedBigInteger('dept_id');

            $table->foreign('dept_id')->references('id')->on('depts');
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
        Schema::dropIfExists('receipts');
    }
}
