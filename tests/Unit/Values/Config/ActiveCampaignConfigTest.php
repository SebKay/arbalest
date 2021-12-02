<?php

use Arbalest\Values\Configs\ActiveCampaignConfig;

test('It throws an error with no API key', function () {
    new ActiveCampaignConfig([
        'account_url' => 'test',
        'list_id'     => 'test',
    ]);
})->throws(\InvalidArgumentException::class);

test('It throws an error with no account URL', function () {
    new ActiveCampaignConfig([
        'api_key'  => 'test',
        'list_id'  => 'test',
    ]);
})->throws(\InvalidArgumentException::class);

test('It throws an error with no list ID', function () {
    new ActiveCampaignConfig([
        'api_key'     => 'test',
        'account_url' => 'test',
    ]);
})->throws(\InvalidArgumentException::class);

test('It returns all the settings', function () {
    $settings = [
        'api_key'     => 'test_api_key',
        'account_url' => 'test_server',
        'list_id'     => 'test_list_id',
    ];

    $config = new ActiveCampaignConfig($settings);

    expect($settings['api_key'])->toBe($config->get('api_key'));
    expect($settings['account_url'])->toBe($config->get('account_url'));
    expect($settings['list_id'])->toBe($config->get('list_id'));
});
