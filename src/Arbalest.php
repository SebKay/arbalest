<?php

declare(strict_types=1);

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
        string $email
    ): bool {
        return $this->service->subscribe(
            new EmailAddress($email)
        );
    }

    /**
     * Unsubscribe email address from configured service
     */
    public function unsubscribe(
        string $email
    ): bool {
        return $this->service->unsubscribe(
            new EmailAddress($email)
        );
    }

    /**
     * Subscribe multiple email addresses to configured service
     *
     * @param array<string> $emails
     */
    public function subscribeAll(
        array $emails
    ): bool {
        return $this->service->subscribeAll($emails);
    }

    /**
     * Unsubscribe multiple email addresses from configured service
     *
     * @param array<string> $emails
     */
    public function unsubscribeAll(
        array $emails
    ): bool {
        return $this->service->unsubscribeAll($emails);
    }
}
