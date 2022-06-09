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
        Schema::create('subject_russias', function (Blueprint $table) {
            $table->id('id_subject');
            $table->string('Name');
            $table->string('ShortName');
            $table->integer('id_district');
            $table->foreign('id_district')->references('id_district')->on('federal_districts');
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
        Schema::dropIfExists('subject_russias');
    }
};
