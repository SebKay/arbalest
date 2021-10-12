<?php

namespace Arbalest\Values;

class ActiveCampaignConfig extends ServiceConfig
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

        if (!$this->get('account_url')) {
            throw new \InvalidArgumentException("'account_url' missing from configuration");
        }

        if (!$this->get('list_id')) {
            throw new \InvalidArgumentException("'list_id' missing from configuration");
        }
    }
}
