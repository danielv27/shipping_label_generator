<?php
use App\Models\CarrierService;
use App\Models\Pricing;

test('get pricing by carrier service id', function () {
    $carrierService = CarrierService::factory()->create();
    Pricing::factory()->count(2)->create(['carrier_service_id' => $carrierService->id]);

    $response = $this->getJson(route('pricing.show', ['carrierServiceId' => $carrierService->id]));

    $response->assertStatus(200)
             ->assertJsonCount(2);
});
