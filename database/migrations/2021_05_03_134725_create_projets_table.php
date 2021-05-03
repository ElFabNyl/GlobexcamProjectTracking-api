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
            $table->unsignedBigInteger('dept_id'); // dept => dettes
            $table->string('name');
            $table->string('assign_to');
            $table->date('starting_date');
            $table->date('ending_date');
            $table->string('status');

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
        Schema::dropIfExists('projets');
    }
}
