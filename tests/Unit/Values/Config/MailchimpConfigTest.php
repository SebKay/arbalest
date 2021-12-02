<?php

use Arbalest\Values\Configs\MailchimpConfig;

test('It throws an error with no API key', function () {
    new MailchimpConfig([
        'server'  => 'test',
        'list_id' => 'test',
    ]);
})->throws(\InvalidArgumentException::class);

test('It throws an error with no server', function () {
    new MailchimpConfig([
        'api_key'  => 'test',
        'list_id'  => 'test',
    ]);
})->throws(\InvalidArgumentException::class);

test('It throws an error with no list ID', function () {
    new MailchimpConfig([
        'api_key' => 'test',
        'server'  => 'test',
    ]);
})->throws(\InvalidArgumentException::class);

test('It returns all the settings', function () {
    $settings = [
        'api_key' => 'test_api_key',
        'server'  => 'test_server',
        'list_id' => 'test_list_id',
    ];

    $config = new MailchimpConfig($settings);

    expect($settings['api_key'])->toBe($config->get('api_key'));
    expect($settings['server'])->toBe($config->get('server'));
    expect($settings['list_id'])->toBe($config->get('list_id'));
});
