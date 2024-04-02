<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('air_quality_data', function (Blueprint $table) {
            $table->id();
            $table->string('sender');
            $table->float('pm10');
            $table->float('pm25');
            $table->float('co');
            $table->float('no2');
            $table->float('ozone');
            $table->dateTime('dateTime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('air_quality_data');
    }
};
