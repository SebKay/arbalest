<?php

namespace Arbalest;

use Arbalest\Interfaces\Subscribable;
use Arbalest\Services\Service;

class Arbalest implements Subscribable
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
        return $this->service->subscribe($email_address);
    }

    /**
     * Unsubscribe an email address from the configured service
     *
     * @param string $email_address
     * @return bool
     */
    public function unsubscribe(string $email_address): bool
    {
        return $this->service->unsubscribe($email_address);
    }
}
