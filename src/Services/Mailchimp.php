<?php

namespace Arbalest\Services;

class Mailchimp
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
