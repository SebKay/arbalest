<?php

namespace Arbalest\Services;

use MailchimpMarketing\Api\PingApi;

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
        $ping = new PingApi($this->service);

        return ($ping->get() ? true : false);
    }
}
