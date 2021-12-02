<?php

declare(strict_types=1);

namespace Arbalest\Interfaces;

use Arbalest\Values\EmailAddress;

interface Subscribable
{
    public function subscribe(EmailAddress $email_address): bool;

    public function unsubscribe(EmailAddress $email_address): bool;

    /**
     * @param array<EmailAddress> $email_addresses
     */
    public function subscribeAll(
        array $email_addresses
    ): bool;

    /**
     * @param array<EmailAddress> $email_addresses
     */
    public function unsubscribeAll(
        array $email_addresses
    ): bool;
}
