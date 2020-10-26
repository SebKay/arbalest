<?php

namespace Arbalest;

use Arbalest\Services\Service;

class Arbalest
{
    /**
     * @var Service
     */
    protected $service;

    /**
     * Set up
     *
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Subscribe an email address to the configured service
     *
     * @param string $email_address
     * @return bool
     */
    public function subscribe(string $email_address): bool
    {
        // TODO: Subscribe email address to service

        return true;
    }

    /**
     * Unsubscribe an email address from the configured service
     *
     * @param string $email_address
     * @return bool
     */
    public function unsubscribe(string $email_address): bool
    {
        // TODO: Unsubscribe email address to service

        return true;
    }
}
