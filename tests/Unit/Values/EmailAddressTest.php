<?php

use Arbalest\Values\EmailAddress;

beforeEach(function () {
    $this->email = 'seb@sebkay.com';
    $this->EmailAddress = new EmailAddress($this->email);
});

test('It returns the correct value', function () {
    expect($this->email)->toBe($this->EmailAddress->get());
});

test('It returns the correct value when called as a string', function () {
    expect($this->email)->toBe((string) $this->EmailAddress);
});

test('It throws an error for an invalid email address', function () {
    new EmailAddress('test');
})->throws(\InvalidArgumentException::class);
