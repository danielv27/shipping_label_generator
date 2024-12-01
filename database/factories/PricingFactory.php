<?php

namespace Database\Factories;
use App\Models\CarrierService;
use App\Models\Pricing;
use Illuminate\Database\Eloquent\Factories\Factory;

class PricingFactory extends Factory
{
    protected $model = Pricing::class;

    public function definition()
    {
        return [
            'carrier_service_id' => CarrierService::factory(), // Creates a related carrier service
            'min_weight' => fake()->randomFloat(2, 0, 5), // Example: 0.00
            'max_weight' => fake()->randomFloat(2, 6, 20), // Example: 20.00
            'price' => fake()->randomFloat(2, 5, 50), // Example: 25.99
            'scope' => fake()->randomElement(['domestic', 'international']), // Example: "domestic"
        ];
    }
}
