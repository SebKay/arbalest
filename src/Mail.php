<?php

namespace Arbalest;

use Arbalest\Services\ServiceInterface;

class Mail
{
    /**
     * @var ServiceInterface
     */
    protected $service;

    /**
     * Set up
     *
     * @param ServiceInterface $service
     */
    public function __construct(ServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Subscribe an email address to the configured service
     *
     * @param string $email_address
     * @return void
     */
    public function subscribe(string $email_address)
    {
        // TODO: Subscribe email address to service
    }

    /**
     * Unsubscribe an email address from the configured service
     *
     * @param string $email_address
     * @return void
     */
    public function unsubscribe(string $email_address)
    {
        // TODO: Unsubscribe email address to service
    }
}
