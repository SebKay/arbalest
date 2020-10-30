<?php

namespace Arbalest\Services;

use Arbalest\Interfaces\Subscribable;
use Arbalest\Values\ServiceConfig;

abstract class Service implements Subscribable
{
    /**
     * @var ServiceConfig
     */
    protected $config;

    /**
     * @var mixed
     */
    protected $service;

    public function __construct(ServiceConfig $config)
    {
        $this->config = $config;
    }

    /**
     * Get configuration options
     *
     * @return ServiceConfig
     */
    public function config(): ServiceConfig
    {
        return $this->config;
    }

    abstract public function checkConnection(): bool;
}
