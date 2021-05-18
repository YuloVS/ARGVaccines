<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAggregatedByResidenceProvinceAndAgeRangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aggregated_by_residence_province_and_age_ranges', function (Blueprint $table) {
            $table->id();
            $table->string("province_of_residence", 20);
            $table->string("age_range", 15);
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
        Schema::dropIfExists('aggregated_by_residence_province_and_age_ranges');
    }
}
