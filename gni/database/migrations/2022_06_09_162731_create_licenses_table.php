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
        Schema::create('licenses', function (Blueprint $table) {
            $table->id('id_license');
            $table->integer('id_company');
            $table->foreign('id_company')->references('id_company')->on('companies');
            $table->integer('id_license_area');
            $table->foreign('id_license_area')->references('id_license_area')->on('license_areas');
            $table->integer('id_agency');
            $table->foreign('id_agency')->references('id_agency')->on('agencies');
            $table->integer('id_special_purpose');
            $table->foreign('id_special_purpose')->references('id_special_purpose')->on('special_purposes');
            $table->integer('id_status');
            $table->foreign('id_status')->references('id_status')->on('status_of_licenses');
            $table->integer('PreviousLicense');
            $table->foreign('PreviousLicense')->references('id_license')->on('licenses')->onDelete('cascade');
            $table->string('TypeOfPrimaryMineral');
            $table->date('DateOfRegistration');
            $table->date('DateOfEnding');
            $table->date('DateOfСancellation');
            $table->string('Seria');
            $table->integer('Number');
            $table->string('Type');
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
        Schema::dropIfExists('licenses');
    }
};
