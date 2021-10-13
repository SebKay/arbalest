<?php

namespace Arbalest\Values\Configs;

abstract class ServiceConfig
{
    protected array $settings;

    public function __construct(
        array $settings
    ) {
        $this->settings = $settings;

        $this->validate();
    }

    abstract protected function validate(): void;

    public function get(string $key): string
    {
        return $this->settings[$key] ?? '';
    }
}
