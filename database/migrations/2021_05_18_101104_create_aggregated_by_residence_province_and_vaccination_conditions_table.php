<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAggregatedByResidenceProvinceAndVaccinationConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aggregated_by_residence_province_and_vaccination_conditions', function (Blueprint $table) {
            $table->id();
            $table->string("province_of_residence", 20);
            $table->string("vaccination_condition", 20);
            $table->unsignedInteger("quantity");
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
        Schema::dropIfExists('aggregated_by_residence_province_and_vaccination_conditions');
    }
}
