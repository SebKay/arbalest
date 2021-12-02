<?php

use Arbalest\Values\Configs\OmnisendConfig;

test('It throws an error with no API key', function () {
    new OmnisendConfig([]);
})->throws(\InvalidArgumentException::class);

test('It returns all the settings', function () {
    $settings = [
        'api_key' => 'test_api_key',
    ];

    $config = new OmnisendConfig($settings);

    expect($settings['api_key'])->toBe($config->get('api_key'));
});
