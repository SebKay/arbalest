<?php

namespace Arbalest\Services;

use Arbalest\Interfaces\Subscribable;
use Arbalest\Values\EmailAddress;
use Arbalest\Values\ServiceConfig;

abstract class Service implements Subscribable
{
    protected ServiceConfig $config;

    public function __construct(
        ServiceConfig $config
    ) {
        $this->config = $config;
    }

    /**
     * Subscribe email address to list
     */
    abstract public function subscribe(
        EmailAddress $email_address
    ): bool;

    /**
     * Unsubscribe email address from list
     */
    abstract public function unsubscribe(
        EmailAddress $email_address
    ): bool;
}
