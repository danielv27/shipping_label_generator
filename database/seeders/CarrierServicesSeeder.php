<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarrierServicesSeeder extends Seeder
{
    public function run()
    {
        DB::table('carrier_services')->insert([
            [
                'name' => 'PostNL Parcel',
                'scope' => 'domestic',
                'price_up_to_1kg' => 1.99,
                'price_up_to_10kg' => 5.99,
                'price_above_10kg' => 10.99,
            ],
            [
                'name' => 'DHL Express',
                'scope' => 'domestic',
                'price_up_to_1kg' => 3.99,
                'price_up_to_10kg' => 8.99,
                'price_above_10kg' => 32.99,
            ],
            [
                'name' => 'DHL Express',
                'scope' => 'international',
                'price_up_to_1kg' => 10.99,
                'price_up_to_10kg' => 30.99,
                'price_above_10kg' => 53.99,
            ],
        ]);
    }
}
