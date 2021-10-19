# Arbalest

[![PHP](https://github.com/SebKay/arbalest/actions/workflows/php.yml/badge.svg)](https://github.com/SebKay/arbalest/actions/workflows/php.yml)

A simple all-in-one solution for managing email list subscribers in PHP.

### Supported

- Mailchimp ([Example](https://github.com/SebKay/arbalest/wiki/Examples#mailchimp))
- Campaign Monitor ([Example](https://github.com/SebKay/arbalest/wiki/Examples#campaign-monitor))
- ConvertKit ([Example](https://github.com/SebKay/arbalest/wiki/Examples#convertkit))
- ActiveCampaign ([Example](https://github.com/SebKay/arbalest/wiki/Examples#activecampaign))
- Omnisend ([Example](https://github.com/SebKay/arbalest/wiki/Examples#omnisend))

## Installation

This package is available on [Packagist](https://packagist.org/) and can be installed via [Composer](https://getcomposer.org/) like so:

```shell
composer require sebkay/arbalest
```

## Usage

First, create the `Arbalest\Arbalest` instance. This is the object you'll use to manage subscribers.

Second, provide the Arbalest instance a service. For example Mailchimp (`Arbalest\Services\Mailchimp`).

Then you can either subscribe or unsubscribe email addresses like so:

```php
// Single
$arbalest->subscribe('test@test.com');

$arbalest->unsubscribe('test@test.com');

// Multiple
$arbalest->subscribeAll([
    'test_1@test.com',
    'test_2@test.com',
    'test_3@test.com',
]);

$arbalest->unsubscribeAll([
    'test_1@test.com',
    'test_2@test.com',
    'test_3@test.com',
]);
```

### Example (Mailchimp)

```php
use Arbalest\Arbalest;
use Arbalest\Services\Mailchimp;

try {
    $arbalest = new Arbalest(
        new Mailchimp([
            'api_key'  => '12345',
            'server'   => 'us2',
            'list_id'  => 'abcde',
        ])
    );

    $arbalest->subscribe('test@test.com');
} catch (\Exception $e) {
    // Do something on error
}
```

## Methods

These are the public methods available on `Arbalest\Arbalest`.

<table>
    <tr>
        <th>
            Method
        </th>
        <th>
            @return
        </th>
    </tr>
    <tr>
        <td>
            <code>subscribe(string $email_address)</code>
        </td>
        <td>
            <code>bool</code>
        </td>
    </tr>
    <tr>
        <td>
            <code>unsubscribe(string $email_address)</code>
        </td>
        <td>
            <code>bool</code>
        </td>
    </tr>
    <tr>
        <td>
            <code>subscribeAll(array $email_addresses)</code>
        </td>
        <td>
            <code>bool</code>
        </td>
    </tr>
    <tr>
        <td>
            <code>unsubscribeAll(array $email_addresses)</code>
        </td>
        <td>
            <code>bool</code>
        </td>
    </tr>
</table>

## Coming Soon

- Hubspot
- GetResponse
- Drip
- Constant Contact
- MailerLite
- Sendinblue
- AWeber
- GetResponse
