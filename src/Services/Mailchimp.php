<?php

namespace Arbalest\Services;

class Mailchimp extends Service
{
    /**
     * @var \MailchimpMarketing\Configuration
     */
    protected $service;

    public function __construct(array $config)
    {
        $this->config = $config;

        $this->service = new \MailchimpMarketing\ApiClient();
        $this->service->setConfig($this->getConfig());
    }

    public function checkConnection(): bool
    {
        return ($this->service->getUsername() ? true : false);
    }
}
