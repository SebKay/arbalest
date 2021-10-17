<?php

namespace Arbalest;

use Arbalest\Services\Service;
use Arbalest\Values\EmailAddress;

class Arbalest
{
    protected Service $service;

    public function __construct(
        Service $service
    ) {
        $this->service = $service;
    }

    /**
     * Subscribe email address to configured service
     */
    public function subscribe(
        string $email_address
    ): bool {
        return $this->service->subscribe(
            new EmailAddress($email_address)
        );
    }

    /**
     * Unsubscribe email address from configured service
     */
    public function unsubscribe(
        string $email_address
    ): bool {
        return $this->service->unsubscribe(
            new EmailAddress($email_address)
        );
    }

    /**
     * Subscribe multiple email addresses to list
     */
    public function subscribeAll(
        array $email_addresses
    ): bool {
        return $this->service->subscribeAll(
            \array_map(function ($email_address) {
                return new EmailAddress($email_address);
            }, $email_addresses)
        );
    }

    /**
     * Unsubscribe multiple email addresses from list
     */
    public function unsubscribeAll(
        array $email_addresses
    ): bool {
        return $this->service->unsubscribeAll(
            \array_map(function ($email_address) {
                return new EmailAddress($email_address);
            }, $email_addresses)
        );
    }
}
