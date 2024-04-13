<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'location' => $this->faker->address,
            'name' => $this->faker->name,
            'com' => 'COM' . $this->faker->randomNumber(2), // Generate a random COM port number
            'sim' => $this->faker->randomNumber(7), // Generate a random 11-digit number as SIM

        ];
    }
}
