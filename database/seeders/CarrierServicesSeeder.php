<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carrier;
use App\Models\CarrierService;

class CarrierServicesSeeder extends Seeder
{
    public function run()
    {
        $postNl = Carrier::where('name', 'PostNL')->first();
        $dhl = Carrier::where('name', 'DHL')->first();
       
        CarrierService::firstOrCreate(['carrier_id' => $postNl->id, 'name' => 'PostNL Parcel', 'scope' => 'domestic']);
        CarrierService::firstOrCreate(['carrier_id' => $dhl->id, 'name' => 'DHL Express', 'scope' => 'domestic']);
        CarrierService::firstOrCreate(['carrier_id' => $dhl->id, 'name' => 'DHL Express', 'scope' => 'international']);
    }
}
