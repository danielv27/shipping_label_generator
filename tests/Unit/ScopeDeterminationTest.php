<?php

use App\Traits\ScopeTrait;

test('Determine domestic scope correctly', function () {
    $trait = new class () {
        use ScopeTrait;
    };
    $scope = $trait->determineScope('NL', 'NL');
    expect($scope)->toBe('domestic');
});

test('Determine international scope correctly', function () {
    $trait = new class () {
        use ScopeTrait;
    };
    $scope = $trait->determineScope('IL', 'US');
    expect($scope)->toBe('international');

    $scope = $trait->determineScope('NL', 'US');
    expect($scope)->toBe('international');

    $scope = $trait->determineScope('US', 'NL');
    expect($scope)->toBe('international');
});
