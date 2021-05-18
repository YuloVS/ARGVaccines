<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccineRegistriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccine_registries', function (Blueprint $table) {
            $table->id();
            $table->char("gender", 1);
            $table->string("age_range", 15);
            $table->string("province_of_residence", 20);
            $table->string("city_of_residence", 120);
            $table->string("vaccinated_in_the_province", 20);
            $table->string("vaccinated_in_the_city", 120);
            $table->date("vaccination_date");
            $table->string("vaccine", 100);
            $table->string("vaccination_condition", 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vaccine_registries');
    }
}
