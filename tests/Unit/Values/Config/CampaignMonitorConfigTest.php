<?php

use Arbalest\Values\Configs\CampaignMonitorConfig;

test('It throws an error with no API key', function () {
    new CampaignMonitorConfig([
        'account_url' => 'test',
        'list_id'     => 'test',
    ]);
})->throws(\InvalidArgumentException::class);

test('It throws an error with no list ID', function () {
    new CampaignMonitorConfig([
        'api_key'     => 'test',
        'account_url' => 'test',
    ]);
})->throws(\InvalidArgumentException::class);

test('It returns all the settings', function () {
    $settings = [
        'api_key'     => 'test_api_key',
        'list_id'     => 'test_list_id',
        'account_url' => 'test_server',
    ];

    $config = new CampaignMonitorConfig($settings);

    expect($settings['api_key'])->toBe($config->get('api_key'));
    expect($settings['list_id'])->toBe($config->get('list_id'));
    expect($settings['account_url'])->toBe($config->get('account_url'));
});
