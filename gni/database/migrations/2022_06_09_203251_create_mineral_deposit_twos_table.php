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
        Schema::create('mineral_deposit_twos', function (Blueprint $table) {
            $table->id('id_deposit');
            $table->foreign('id_deposit')->references('id_deposit')->on('mineral_deposits');
            $table->id('id_subject');
            $table->foreign('id_subject')->references('id_subject')->on('subject_russias');
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
        Schema::dropIfExists('mineral_deposit_twos');
    }
};
