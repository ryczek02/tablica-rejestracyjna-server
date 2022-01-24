<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LicensePlateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'region' => $this->faker->randomElement(\App\Models\Region::all()->pluck('unique_name')),
            'unique_plate' => $this->faker->regexify('[A-Z0-9]{5}')
        ];
    }
}
