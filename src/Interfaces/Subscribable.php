<?php

declare(strict_types=1);

namespace Arbalest\Interfaces;

use Arbalest\Values\EmailAddress;

interface Subscribable
{
    public function subscribe(EmailAddress $email): bool;

    public function unsubscribe(EmailAddress $email): bool;

    /**
     * @param array<EmailAddress> $email
     */
    public function subscribeAll(
        array $email
    ): bool;

    /**
     * @param array<EmailAddress> $email
     */
    public function unsubscribeAll(
        array $email
    ): bool;
}
