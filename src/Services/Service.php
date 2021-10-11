<?php

namespace Arbalest\Services;

use Arbalest\Interfaces\Subscribable;
use Arbalest\Values\ServiceConfig;

abstract class Service implements Subscribable
{
    protected ServiceConfig $config;

    public function __construct(
        ServiceConfig $config
    ) {
        $this->config = $config;
    }
}
