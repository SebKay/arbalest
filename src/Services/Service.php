<?php

namespace Arbalest\Services;

use Arbalest\SubscribableInterface;

abstract class Service implements SubscribableInterface
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var mixed
     */
    protected $service;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Get configuration options
     *
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    abstract public function checkConnection(): bool;

    abstract public function subscribe(string $email_address): bool;

    abstract public function unsubscribe(string $email_address): bool;
}
