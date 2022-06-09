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
        Schema::create('mest_l_u_s', function (Blueprint $table) {
            $table->integer('id_deposit');
            $table->foreign('id_deposit')->references('id_deposit')->on('mineral_deposits');
            $table->integer('id_license_area');
            $table->foreign('id_license_area')->references('id_license_area')->on('license_areas');
            $table->primary(['id_deposit', 'id_license_area']);
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
        Schema::dropIfExists('mest_l_u_s');
    }
};
