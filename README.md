# Arbalest

[![PHP](https://github.com/SebKay/arbalest/actions/workflows/php.yml/badge.svg)](https://github.com/SebKay/arbalest/actions/workflows/php.yml)

A simple all-in-one solution for managing email list subscribers in PHP.

### Supported

- Mailchimp ([Example](https://github.com/SebKay/arbalest/wiki/Examples#mailchimp))
- Campaign Monitor ([Example](https://github.com/SebKay/arbalest/wiki/Examples#campaign-monitor))
- ConvertKit ([Example](https://github.com/SebKay/arbalest/wiki/Examples#convertkit))
- ActiveCampaign ([Example](https://github.com/SebKay/arbalest/wiki/Examples#activecampaign))

## Installation

This package is available on [Packagist](https://packagist.org/) and can be installed via [Composer](https://getcomposer.org/) like so:

```shell
composer require sebkay/arbalest
```

## Usage

First, create the `Arbalest\Arbalest` instance. This is the object you'll use to manage subscribers.

Second, provide the Arbalest instance a service. For example Mailchimp (`Arbalest\Services\Mailchimp`).

Then you can either subscribe or unsubscribe an email address like so:

```php
// Subscribe email address to service
$arbalest->subscribe('test@test.com');

// Unsubscribe email address from service
$arbalest->unsubscribe('test@test.com');
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
</table>

## Coming Soon

- Hubspot
- ActiveCampaign
- GetResponse
- Drip
- Constant Contact
- MailerLite
- Sendinblue
- AWeber
- GetResponse
- Omnisend
