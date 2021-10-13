<?php

namespace Arbalest\Values\Configs;

abstract class ServiceConfig
{
    protected array $settings;
    protected array $requiredSettings = [];

    public function __construct(
        array $settings
    ) {
        $this->settings = $settings;

        $this->validate();
    }

    final protected function validate(): void
    {
        foreach ($this->requiredSettings as $settingKey) {
            if (!isset($this->settings[$settingKey])) {
                throw new \InvalidArgumentException("'{$settingKey}' is missing from configuration");
            }
        }
    }

    final public function get(string $key): string
    {
        return $this->settings[$key] ?? '';
    }
}
