<?php

use App\Http\Controllers\PricingController;

test('pricing scope derived correctly', function () {
    $controller = new PricingController();

    expect($controller->determineScope('Netherlands', 'Netherlands'))->toBe('domestic');
    expect($controller->determineScope('Netherlands', 'Belgium'))->toBe('international');
    expect($controller->determineScope('Belguim', 'Netherlands'))->toBe('international');
    expect($controller->determineScope('Belguim', 'Belgium'))->toBe('international');
});
