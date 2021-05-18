<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAggregatedByResidenceProvinceAndVaccinationDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aggregated_by_residence_province_and_vaccination_dates', function (Blueprint $table) {
            $table->id();
            $table->string("province_of_residence", 20);
            $table->date("vaccination_date");
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
        Schema::dropIfExists('aggregated_by_residence_province_and_vaccination_dates');
    }
}
