<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAggregatedByVaccinationConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aggregated_by_vaccination_conditions', function (Blueprint $table) {
            $table->id();
            $table->string("vaccination_condition", 20);
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
        Schema::dropIfExists('aggregated_by_vaccination_conditions');
    }
}
