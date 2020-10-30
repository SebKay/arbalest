<?php

namespace Arbalest\Values;

class MailchimpConfig extends ServiceConfig
{
    public function __construct(array $settings)
    {
        $this->settings = $settings;

        if (!isset($this->settings['apiKey'])) {
            throw new \InvalidArgumentException("'apiKey' missing from configuration.");
        }

        if (!isset($this->settings['server'])) {
            throw new \InvalidArgumentException("'server' missing from configuration.");
        }

        if (!isset($this->settings['list_id'])) {
            throw new \InvalidArgumentException("'list_id' missing from configuration.");
        }
    }
}
