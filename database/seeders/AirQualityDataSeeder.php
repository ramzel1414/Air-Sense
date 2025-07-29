<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AirQualityData;

class AirQualityDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate 17,520 rows of data
        AirQualityData::factory()->count(10000)->create();
    }
}
