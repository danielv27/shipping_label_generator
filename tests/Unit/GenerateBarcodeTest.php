<?php

use App\Models\Label;

uses(Tests\TestCase::class, Illuminate\Foundation\Testing\RefreshDatabase::class);

test('generates correct barcodes sequentially', function () {

    Label::factory(10)->create();

    $controller = new \App\Http\Controllers\LabelController();
    $barcode = $controller->generateBarcode();

    expect($barcode)->toBe('MP00000011');
});