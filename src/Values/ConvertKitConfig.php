<?php

namespace Arbalest\Values;

class ConvertKitConfig extends ServiceConfig
{
    public function __construct(
        array $settings
    ) {
        parent::__construct($settings);
    }

    protected function validate(): void
    {
        if (!$this->get('api_key')) {
            throw new \InvalidArgumentException("'api_key' missing from configuration");
        }

        if (!$this->get('api_secret')) {
            throw new \InvalidArgumentException("'api_secret' missing from configuration");
        }

        if (!$this->get('form_id')) {
            throw new \InvalidArgumentException("'form_id' missing from configuration");
        }
    }
}
