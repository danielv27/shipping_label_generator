<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarrierService;

class CarrierServiceSeeder extends Seeder
{
    public function run()
    {
        CarrierService::firstOrCreate(['name' => 'PostNL Parcel']);
        CarrierService::firstOrCreate(['name' => 'DHL Express']);
    }
}
