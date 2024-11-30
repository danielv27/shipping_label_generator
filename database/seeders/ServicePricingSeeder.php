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
                    ['min_weight' => 0.00, 'max_weight' => 2.00, 'price' => 2.99],
                    ['min_weight' => 2.01, 'max_weight' => 10.00, 'price' => 6.99],
                    ['min_weight' => 10.01, 'max_weight' => 20.00, 'price' => 14.99],
                ],
            ],
            'DHL Express' => [
                'domestic' => [
                    ['min_weight' => 0.00, 'max_weight' => 1.00, 'price' => 3.99],
                    ['min_weight' => 1.01, 'max_weight' => 10.00, 'price' => 8.99],
                    ['min_weight' => 10.01, 'max_weight' => 999.00, 'price' => 32.99],
                ],
                'international' => [
                    ['min_weight' => 0.00, 'max_weight' => 1.00, 'price' => 10.99],
                    ['min_weight' => 1.01, 'max_weight' => 10.00, 'price' => 30.99],
                    ['min_weight' => 10.01, 'max_weight' => 999.00, 'price' => 53.99],
                ],
            ],
        ];
        foreach ($pricingData as $carrierName => $services) {
            $carrier = Carrier::where('name', $carrierName)->first();

            if (! $carrier) {
                $this->command->warn("Carrier '$carrierName' not found. Skipping.");
                continue;
            }

            foreach ($services as $scope => $pricingRules) {
                $carrierService = CarrierService::firstOrCreate([
                    'carrier_id' => $carrier->id,
                    'scope' => $scope,
                ]);

                foreach ($pricingRules as $rule) {
                    ServicePricing::firstOrCreate(
                        [
                            'carrier_service_id' => $carrierService->id,
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
