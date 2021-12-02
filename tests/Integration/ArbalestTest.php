<?php

use Arbalest\Arbalest;
use Arbalest\Services\Service;

beforeEach(function () {
    $this->faker = \Faker\Factory::create();

    /**
     * @var Service|\PHPUnit\Framework\MockObject\Stub
     */
    $service_mock = $this->createStub(Service::class);

    $service_mock
        ->method('subscribe')
        ->willReturn(true);

    $service_mock
        ->method('unsubscribe')
        ->willReturn(true);

    $this->app = new Arbalest($service_mock);
});

test('It returns a true boolean when subscribing an email address', function () {
    expect($this->app->subscribe($this->faker->email))->toBeBool();
});

test('It returns a true boolean when unsubscribing an email address', function () {
    expect($this->app->unsubscribe($this->faker->email))->toBeBool();
});

test('It returns a true boolean when subscribing multiple email addresses', function () {
    expect($this->app->subscribeAll([
        $this->faker->email,
        $this->faker->email,
        $this->faker->email,
    ]))->toBeBool();
});

test('It returns a true boolean when unsubscribing multiple email addresses', function () {
    expect($this->app->unsubscribeAll([
        $this->faker->email,
        $this->faker->email,
        $this->faker->email,
    ]))->toBeBool();
});
