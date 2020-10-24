<?php

namespace Arbalest\Services;

abstract class Service implements ServiceInterface
{
    /**
     * @var array
     */
    protected $config;

    /**
     * Setup
     *
     * @param array $config
     */
    public function __construct($config)
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
}
