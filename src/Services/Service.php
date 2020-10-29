<?php

namespace Arbalest\Services;

use Arbalest\Interfaces\Subscribable;

abstract class Service implements Subscribable
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
}
