<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQtyByLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qty_by_locations', function (Blueprint $table) {
            $table->id();
            $table->string("province",20);
            $table->string("vaccine", 100);
            $table->unsignedInteger("first_dose");
            $table->unsignedInteger("second_dose");
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
        Schema::dropIfExists('qty_by_locations');
    }
}
