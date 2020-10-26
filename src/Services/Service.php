<?php

namespace Arbalest\Services;

abstract class Service
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var mixed
     */
    protected $service;

    /**
     * Setup
     *
     * @param array $config
     */
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

    /**
     * Check the service is working
     */
    abstract public function checkConnection(): bool;
}
