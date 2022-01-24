<?php

namespace Database\Factories;

use App\Models\LicensePlate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'license_plate_id' => LicensePlate::select('id')->get()->random()->id,
            'user_id' => User::select('id')->get()->random()->id,
            'description' => $this->faker->text
        ];
    }
}
