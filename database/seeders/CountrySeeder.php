<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $csvUrl = 'https://datahub.io/core/country-list/_r/-/data.csv';
        $csvData = array_map('str_getcsv', file($csvUrl));

        foreach ($csvData as $index => $row) {
            if ($index === 0) continue; // Skip the header row
            Country::updateOrCreate(
                ['name' => $row[0]],
                ['code' => $row[1]] 
            );
        }
    }
}