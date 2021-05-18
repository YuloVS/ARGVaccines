<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAggregatedByVaccinationProvinceAndVaccinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aggregated_by_vaccination_province_and_vaccines', function (Blueprint $table) {
            $table->id();
            $table->string("vaccinated_in_the_province", 20);
            $table->string("vaccine", 100);
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
        Schema::dropIfExists('aggregated_by_vaccination_province_and_vaccines');
    }
}
