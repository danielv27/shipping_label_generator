<?php

use Database\Seeders\CarrierServiceSeeder;

test('calculates correct prices for PostNL Parcel', function () {

    $this->seed();

    $this->postJson(route('pricing.calculate'), [
            'carrier_service_id' => 1, // PostNL Parcel
            'sender_country_code' => 'NL',
            'receiver_country_code' => 'NL',
            'weight' => 0.5,
        ])
        ->assertStatus(200)
        ->assertJson(['price' => 1.99]);

    $this->postJson(route('pricing.calculate'), [
            'carrier_service_id' => 1,
            'sender_country_code' => 'NL',
            'receiver_country_code' => 'NL',
            'weight' => 5,
        ])
        ->assertStatus(200)
        ->assertJson(['price' => 5.99]);

    $this->postJson(route('pricing.calculate'), [
            'carrier_service_id' => 1,
            'sender_country_code' => 'NL',
            'receiver_country_code' => 'NL',
            'weight' => 12,
        ])
        ->assertStatus(200)
        ->assertJson(['price' => 10.99]);
});

test('calculates correct prices for DHL Express (Domestic)', function () {
    $this->seed(CarrierServiceSeeder::class);

    // Test weight within 0-1kg range
    $response = $this->postJson(route('pricing.calculate'), [
        'carrier_service_id' => 2, // DHL Express (Domestic)
        'sender_country_code' => 'NL',
        'receiver_country_code' => 'NL',
        'weight' => 0.5,
    ]);
    $response->assertStatus(200)->assertJson(['price' => 3.99]);

    // Test weight within 1.01-10kg range
    $response = $this->postJson(route('pricing.calculate'), [
        'carrier_service_id' => 2,
        'sender_country_code' => 'NL',
        'receiver_country_code' => 'NL',
        'weight' => 5,
    ]);
    $response->assertStatus(200)->assertJson(['price' => 8.99]);

    // Test weight above 10kg
    $response = $this->postJson(route('pricing.calculate'), [
        'carrier_service_id' => 2,
        'sender_country_code' => 'NL',
        'receiver_country_code' => 'NL',
        'weight' => 15,
    ]);
    $response->assertStatus(200)->assertJson(['price' => 32.99]);
});

test('calculates correct prices for DHL Express (International)', function () {
    $this->seed(CarrierServiceSeeder::class);

    // Test weight within 0-1kg range
    $response = $this->postJson(route('pricing.calculate'), [
        'carrier_service_id' => 3, // DHL Express (International)
        'sender_country_code' => 'NL',
        'receiver_country_code' => 'US',
        'weight' => 0.8,
    ]);
    $response->assertStatus(200)->assertJson(['price' => 10.99]);

    // Test weight within 1.01-10kg range
    $response = $this->postJson(route('pricing.calculate'), [
        'carrier_service_id' => 3,
        'sender_country_code' => 'NL',
        'receiver_country_code' => 'US',
        'weight' => 7,
    ]);
    $response->assertStatus(200)->assertJson(['price' => 30.99]);

    // Test weight above 10kg
    $response = $this->postJson(route('pricing.calculate'), [
        'carrier_service_id' => 3,
        'sender_country_code' => 'NL',
        'receiver_country_code' => 'US',
        'weight' => 15,
    ]);
    $response->assertStatus(200)->assertJson(['price' => 53.99]);
});
