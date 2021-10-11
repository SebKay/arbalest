# Arbalest

[![PHP](https://github.com/SebKay/arbalest/actions/workflows/php.yml/badge.svg)](https://github.com/SebKay/arbalest/actions/workflows/php.yml)

A simple all-in-one solution for managing email list subscribers in PHP.

---

## Usage

### Mailchimp

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

### Campaign Monitor

```php
use Arbalest\Arbalest;
use Arbalest\Services\CampaignMonitor;

try {
    $arbalest = new Arbalest(
        new CampaignMonitor([
            'api_key'  => '12345',
            'list_id'  => 'abcde',
        ])
    );

    $arbalest->subscribe('test@test.com');
} catch (\Exception $e) {
    // Do something on error
}
```

### ConvertKit

```php
use Arbalest\Arbalest;
use Arbalest\Services\ConvertKit;

try {
    $arbalest = new Arbalest(
        new ConvertKit([
            'api_key'     => '5p8FOzuGCTumTuXe9j3_bw',
            'api_secret'  => 'dCLBIVC60aDe2Fe8N8xem-92ZUeB_WXJlWUY3O1RfHA',
            'form_id'     => '2677178',
        ])
    );

    $arbalest->subscribe('test@test.com');
} catch (\Exception $e) {
    // Do something on error
}
```

### Coming Soon

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

---

## Installation

This package is available on [Packagist](https://packagist.org/) and can be installed via [Composer](https://getcomposer.org/) like so:

```shell
composer require sebkay/arbalest
```

After installing you can start using Arbalest in two steps.

First, create the `Arbalest\Arbalest` instance, this is the main class you'll use to manage subscribers.

Second, provide the Arbalest instance a service. You can see the example above where we use the Mailchimp (`Arbalest\Services\Mailchimp`) service.

Then you can either subscribe or unsubscribe an email address like so:

```php
// Subscribe email address to service
$arbalest->subscribe('test@test.com');

// Unsubscribe email address to service
$arbalest->unsubscribe('test@test.com');
```

Each of the above methods return a `boolean` (`true` on success and `false` on failure).
