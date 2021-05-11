<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('client_name');
            $table->unsignedBigInteger('general_price');
            $table->unsignedBigInteger('amount_payed');
            $table->string('assign_to');
            $table->datetime('starting_date')->default(now());
            $table->datetime('ending_date');
            $table->enum('status',['EN COUR','TERMINER', 'STOPPER'])->default('EN COUR');
            $table->enum('category',['SITE WEB','GRAPHIC DESIGN','VIDEO']);

            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('projets');
    }
}
