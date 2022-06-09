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
        Schema::create('companies', function (Blueprint $table) {
            $table->id('id_company');
            $table->string('NameCompany');
            $table->text('Address');
            $table->integer('INN');
            $table->integer('CodeOKPO');
            $table->integer('CodeOKATO');
            $table->integer('OGRN');
            $table->text('Addition');
            $table->integer('ManagementCompany');
            $table->foreign('ManagementCompany')->references('id_company')->on('companies')->onDelete('cascade');
            $table->text('CurrentState');
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
        Schema::dropIfExists('companies');
    }
};
