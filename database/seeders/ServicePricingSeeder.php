<?php

namespace Database\Seeders;

use App\Models\Carrier;
use App\Models\CarrierService;
use App\Models\ServicePricing;
use Illuminate\Database\Seeder;

class ServicePricingSeeder extends Seeder
{
    public function run(): void
    {
        $pricingData = [
            'PostNL Parcel' => [
                'domestic' => [
                    ['min_weight' => 0, 'max_weight' => 1, 'price' => 1.99],
                    ['min_weight' => 1.01, 'max_weight' => 10, 'price' => 5.99],
                    ['min_weight' => 10.01, 'max_weight' => 999999, 'price' => 10.99],
                ],
            ],
            'DHL Express' => [
                'domestic' => [
                    ['min_weight' => 0, 'max_weight' => 1, 'price' => 3.99],
                    ['min_weight' => 1.01, 'max_weight' => 10, 'price' => 8.99],
                    ['min_weight' => 10.01, 'max_weight' => 999999, 'price' => 32.99],
                ],
                'international' => [
                    ['min_weight' => 0.00, 'max_weight' => 1.00, 'price' => 10.99],
                    ['min_weight' => 1.01, 'max_weight' => 10.00, 'price' => 30.99],
                    ['min_weight' => 10.01, 'max_weight' => 999999, 'price' => 53.99],
                ],
            ],
        ];
        foreach ($pricingData as $carrierName => $services) {
            $carrierService = CarrierService::where('name', $carrierName)->first();

            if (! $carrierService) {
                $this->command->warn("Carrier '$carrierName' not found. Skipping.");
                continue;
            }

            foreach ($services as $scope => $pricingRules) {
                foreach ($pricingRules as $rule) {
                    ServicePricing::firstOrCreate(
                        [
                            'carrier_service_id' => $carrierService->id,
                            'scope' => $scope,
                            'min_weight' => $rule['min_weight'],
                            'max_weight' => $rule['max_weight'],
                            'price' => $rule['price'],
                        ],
                    );
                }
            }
        }
    }

}
