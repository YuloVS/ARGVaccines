<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAggregatedByVaccinationProvinceAndVaccinationDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aggregated_by_vaccination_province_and_vaccination_dates', function (Blueprint $table) {
            $table->id();
            $table->string("vaccinated_in_the_province", 20);
            $table->date("vaccination_date");
            $table->unsignedInteger("quantity");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aggregated_by_vaccination_province_and_vaccination_dates');
    }
}
