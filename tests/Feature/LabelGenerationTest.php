<?php

use App\Models\Label;
use Database\Seeders\CountrySeeder;
use Smalot\PdfParser\Parser;
use App\Models\CarrierService;

test('Label generation validates required fields', function () {
    $this->postJson(route('label.generate'), [])
        ->assertStatus(422)
        ->assertJsonValidationErrors([
            'recipient_name',
            'recipient_street',
            'recipient_postal_code',
            'recipient_city',
            'recipient_country',
            'carrier_service_id',
        ]);
});

test('Label generation passes with all required fields', function () {
    // Arrange: Seed database and create carrier service
    $this->seed(CountrySeeder::class);
    $carrierService = CarrierService::factory()->create();

    // Arrange valid payload
    $validPayload = [
        'recipient_name' => 'John Doe',
        'recipient_street' => '123 Main St',
        'recipient_postal_code' => '12345',
        'recipient_city' => 'Amsterdam',
        'recipient_country' => 'NL', // Country code used in the request
        'carrier_service_id' => $carrierService->id,
    ];

    $this->postJson(route('label.generate'), $validPayload)
        ->assertStatus(200)
        ->assertDownload();
});


test('Label PDF contains correct shipping details', function () {
    // Arrange: Seed database and create carrier service
    $this->seed(CountrySeeder::class);
    $carrierService = CarrierService::factory()->create(['name' => 'DHL Express']);

    $expectedDetails = [
        'recipient_name' => 'John Doe',
        'recipient_street' => '123 Main St',
        'recipient_postal_code' => '12345',
        'recipient_city' => 'Amsterdam',
        'recipient_country' => 'Netherlands',
        'carrier_service_name' => $carrierService->name,
    ];

    $response = $this->postJson(route('label.generate'), [
        'recipient_name' => $expectedDetails['recipient_name'],
        'recipient_street' => $expectedDetails['recipient_street'],
        'recipient_postal_code' => $expectedDetails['recipient_postal_code'],
        'recipient_city' => $expectedDetails['recipient_city'],
        'recipient_country' => 'NL',
        'carrier_service_id' => $carrierService->id,
    ]);

    $parser = new Parser();
    $pdfContent = $parser->parseContent($response->getContent())->getText();

    foreach ($expectedDetails as $key => $value) {
        expect($pdfContent)->toContain($value);
    }
});

test('Label PDF contains correct barcode value', function () {

    $this->seed(CountrySeeder::class);
    $label = Label::factory(30)->create();

    $response = $this->postJson(route('label.generate'), [
        'recipient_name' => 'John Doe',
        'recipient_street' => '123 Main St',
        'recipient_postal_code' => '12345',
        'recipient_city' => 'Amsterdam',
        'recipient_country' => 'NL',
        'carrier_service_id' => 1,
    ]);

    $response
        ->assertStatus(200)
        ->assertDownload();

    $parser = new Parser();
    $pdfContent = $parser->parseContent($response->getContent())->getText();

    // If 30 labels were already created the next label should have a barcode with 31
    $expectedBarcode = 'MP00000031';
    expect($pdfContent)->toContain($expectedBarcode);
});
