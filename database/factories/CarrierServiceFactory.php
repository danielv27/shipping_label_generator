<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarrierServiceFactory extends Factory
{
    public function definition(): array
    {
        return ['name' => fake()->company()];
    }
}
