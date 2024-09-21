<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirQualityDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('air_quality_data', function (Blueprint $table) {
            $table->id();
            $table->string('sender');
            $table->float('pm10');
            $table->float('pm25');
            $table->float('co');
            $table->float('no2');
            $table->float('ozone', 8, 3); // Define 'ozone' column with 3 decimal places
            $table->dateTime('dateTime');
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
        Schema::dropIfExists('air_quality_data');
    }
}
