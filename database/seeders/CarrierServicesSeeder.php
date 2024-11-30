<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carrier;
use App\Models\CarrierService;

class CarrierServicesSeeder extends Seeder
{
    public function run()
    {
        $dhl = Carrier::where('name', 'DHL')->first();
        $postNl = Carrier::where('name', 'PostNL')->first();

        CarrierService::firstOrCreate(['carrier_id' => $dhl->id, 'scope' => 'domestic']);
        CarrierService::firstOrCreate(['carrier_id' => $dhl->id, 'scope' => 'international']);
        CarrierService::firstOrCreate(['carrier_id' => $postNl->id, 'scope' => 'domestic']);
    }
}
