<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('amount_to_pay');
            $table->integer('amount_payed');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('projet_id');
            $table->unsignedBigInteger('receipt_id'); // reçu

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('projet_id')->references('id')->on('projets');
            $table->foreign('receipt_id')->references('id')->on('receipts');
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
        Schema::dropIfExists('depts');
    }
}
