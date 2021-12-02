<?php

use Arbalest\Values\Configs\ConvertKitConfig;

test('It throws an error with no API key', function () {
    new ConvertKitConfig([
        'api_secret' => 'test',
        'form_id'    => 'test',
    ]);
})->throws(\InvalidArgumentException::class);

test('It throws an error with no API secret', function () {
    new ConvertKitConfig([
        'api_key' => 'test',
        'form_id' => 'test',
    ]);
})->throws(\InvalidArgumentException::class);

test('It throws an error with no form ID', function () {
    new ConvertKitConfig([
        'api_key'    => 'test',
        'api_secret' => 'test',
    ]);
})->throws(\InvalidArgumentException::class);

test('It returns all the settings', function () {
    $settings = [
        'api_key'    => 'test_api_key',
        'api_secret' => 'test_api_secret',
        'form_id'    => 'test_form_id',
    ];

    $config = new ConvertKitConfig($settings);

    expect($settings['api_key'])->toBe($config->get('api_key'));
    expect($settings['api_secret'])->toBe($config->get('api_secret'));
    expect($settings['form_id'])->toBe($config->get('form_id'));
});
