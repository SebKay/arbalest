<?php

namespace Arbalest\Services;

interface ServiceInterface
{
    /**
     * Setup
     *
     * @param array $config
     */
    public function __construct($config);

    /**
     * Get configuration options
     *
     * @return array
     */
    public function getConfig(): array;
}
