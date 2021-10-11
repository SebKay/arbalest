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
}
