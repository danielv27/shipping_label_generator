<?php

use App\Models\CarrierService;

test('validates required fields for price calculation', function () {
    $this->postJson(route('pricing.calculate'), [])
        ->assertStatus(422)
        ->assertJsonValidationErrors([
            'carrier_service_id',
            'sender_country_code',
            'recipient_country_code',
            'weight',
        ]);
});


test('calculates correct prices for PostNL Parcel', function () {

    $this->seed();

    $carrierServiceId = CarrierService::where('name', 'PostNL Parcel')->first()->id;

    $this->postJson(route('pricing.calculate'), [
            'carrier_service_id' => $carrierServiceId,
            'sender_country_code' => 'NL',
            'recipient_country_code' => 'NL',
            'weight' => 0.5,
        ])
        ->assertStatus(200)
        ->assertJson(['price' => 1.99]);

    $this->postJson(route('pricing.calculate'), [
            'carrier_service_id' => $carrierServiceId,
            'sender_country_code' => 'NL',
            'recipient_country_code' => 'NL',
            'weight' => 5,
        ])
        ->assertStatus(200)
        ->assertJson(['price' => 5.99]);

    $this->postJson(route('pricing.calculate'), [
            'carrier_service_id' => $carrierServiceId,
            'sender_country_code' => 'NL',
            'recipient_country_code' => 'NL',
            'weight' => 12,
        ])
        ->assertStatus(200)
        ->assertJson(['price' => 10.99]);
});

test('calculating international prices for PostNL Parcel does not exist', function () {

    $this->seed();

    $carrierServiceId = CarrierService::where('name', 'PostNL Parcel')->first()->id;

    $this->postJson(route('pricing.calculate'), [
            'carrier_service_id' => $carrierServiceId,
            'sender_country_code' => 'NL',
            'recipient_country_code' => 'US',
            'weight' => 0.5,
        ])->assertStatus(404);

    $this->postJson(route('pricing.calculate'), [
            'carrier_service_id' => $carrierServiceId,
            'sender_country_code' => 'US',
            'recipient_country_code' => 'NL',
            'weight' => 5,
        ])->assertStatus(404);

    $this->postJson(route('pricing.calculate'), [
            'carrier_service_id' => $carrierServiceId,
            'sender_country_code' => 'NL',
            'recipient_country_code' => 'US',
            'weight' => 12,
        ])->assertStatus(404);
});

test('calculates correct prices for DHL Express (domestic)', function () {

    $this->seed();

    $carrierServiceId = CarrierService::where('name', 'DHL Express')->first()->id;

    $this->postJson(route('pricing.calculate'), [
            'carrier_service_id' => $carrierServiceId,
            'sender_country_code' => 'NL',
            'recipient_country_code' => 'NL',
            'weight' => 0.5,
        ])
        ->assertStatus(200)
        ->assertJson(['price' => 3.99]);

    $this->postJson(route('pricing.calculate'), [
            'carrier_service_id' => $carrierServiceId,
            'sender_country_code' => 'NL',
            'recipient_country_code' => 'NL',
            'weight' => 5,
        ])
        ->assertStatus(200)
        ->assertJson(['price' => 8.99]);

    $this->postJson(route('pricing.calculate'), [
            'carrier_service_id' => $carrierServiceId,
            'sender_country_code' => 'NL',
            'recipient_country_code' => 'NL',
            'weight' => 12,
        ])
        ->assertStatus(200)
        ->assertJson(['price' => 32.99]);
});

test('calculates correct prices for DHL Express (international)', function () {

    $this->seed();
    $carrierServiceId = CarrierService::where('name', 'DHL Express')->first()->id;

    $this->postJson(route('pricing.calculate'), [
            'carrier_service_id' => $carrierServiceId,
            'sender_country_code' => 'NL',
            'recipient_country_code' => 'DE',
            'weight' => 0.5,
        ])
        ->assertStatus(200)
        ->assertJson(['price' => 10.99]);

    $this->postJson(route('pricing.calculate'), [
            'carrier_service_id' => $carrierServiceId,
            'sender_country_code' => 'NL',
            'recipient_country_code' => 'DE',
            'weight' => 5,
        ])
        ->assertStatus(200)
        ->assertJson(['price' => 30.99]);

    $this->postJson(route('pricing.calculate'), [
            'carrier_service_id' => $carrierServiceId,
            'sender_country_code' => 'NL',
            'recipient_country_code' => 'DE',
            'weight' => 12,
        ])
        ->assertStatus(200)
        ->assertJson(['price' => 53.99]);
});

