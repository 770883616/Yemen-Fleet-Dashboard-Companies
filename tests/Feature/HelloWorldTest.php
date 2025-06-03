<?php

use Pest\Feature;

it('returns hello world', function () {
    $response = 'Hello World';
    expect($response)->toBe('Hello World');
});