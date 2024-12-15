<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AirQualityData>
 */
class AirQualityDataFactory extends Factory
{
    public function definition(): array
    {
        // Random classification (green or yellow)
        $classification = $this->faker->randomElement(['green', 'yellow']);

        return [
            'sender' => 'Sensor-' . $this->faker->numberBetween(1, 10),
            'pm10' => $classification === 'green'
                ? $this->faker->numberBetween(0, 54)
                : $this->faker->numberBetween(55, 154),
            'pm25' => $classification === 'green'
                ? $this->faker->randomFloat(1, 0, 25)
                : $this->faker->randomFloat(1, 25.1, 35),
            'co' => $classification === 'green'
                ? $this->faker->randomFloat(1, 0, 25)
                : $this->faker->randomFloat(1, 25.1, 50),
            'no2' => $classification === 'green'
                ? $this->faker->randomFloat(2, 0, 0.05)
                : $this->faker->randomFloat(2, 0.06, 0.10),
            'ozone' => $classification === 'green'
                ? $this->faker->randomFloat(3, 0, 0.064)
                : $this->faker->randomFloat(3, 0.065, 0.084),
            'dateTime' => Carbon::now()->subYears(2)->addHours($this->faker->numberBetween(0, 17520)),
        ];
    }
}
