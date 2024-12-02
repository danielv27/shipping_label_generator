<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CarrierService;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Label>
 */
class LabelFactory extends Factory
{
    public function definition()
    {
        return [
            'recipient_name' => fake()->name(),
            'recipient_street' => fake()->streetAddress(),
            'recipient_postal_code' => fake()->postcode(),
            'recipient_city' => fake()->city(),
            'recipient_country' => fake()->countryCode(),
            'carrier_service_id' => CarrierService::factory(),
        ];
    }
}
