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
        Schema::create('mineral_deposits', function (Blueprint $table) {
            $table->id('id_deposit');
            $table->integer('id_osvoenie');
            $table->foreign('id_osvoenie')->references('id_osvoenie')->on('stepen_osvoenias');
            $table->string('DepostName');
            $table->text('Coordinates');
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
        Schema::dropIfExists('mineral_deposits');
    }
};
