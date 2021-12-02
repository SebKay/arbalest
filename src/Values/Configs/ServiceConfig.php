<?php

declare(strict_types=1);

namespace Arbalest\Values\Configs;

abstract class ServiceConfig
{
    /**
     * @var array<string>
     */
    protected array $settings;

    /**
     * @var array<string>
     */
    protected array $requiredSettings = [];

    /**
     * @param array<string> $settings
     */
    public function __construct(
        array $settings
    ) {
        $this->settings = $settings;

        $this->validate();
    }

    public function get(string $key): string
    {
        return $this->settings[$key] ?? '';
    }

    protected function validate(): void
    {
        foreach ($this->requiredSettings as $settingKey) {
            if (! isset($this->settings[$settingKey])) {
                throw new \InvalidArgumentException(
                    "'{$settingKey}' is missing from configuration"
                );
            }
        }
    }
}
