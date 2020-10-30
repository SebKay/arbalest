<?php

namespace Arbalest\Values;

use Arbalest\Interfaces\ValueObject;

abstract class ServiceConfig implements ValueObject
{
    /**
     * @var array
     */
    protected $settings;

    public function __construct(array $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Get settings array
     *
     * @return array
     */
    public function get(): array
    {
        return $this->settings;
    }
}
