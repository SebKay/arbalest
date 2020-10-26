<?php

namespace Arbalest\Services;

class Mailchimp extends Service
{
    /**
     * @var \MailchimpMarketing\Configuration
     */
    protected $service;

    public function __construct($config)
    {
        $this->config = $config;

        $this->service = new \MailchimpMarketing\ApiClient();
        $this->service->setConfig($this->getConfig());
    }

    protected function checkConnection()
    {
        return $this->service->getHost();
    }
}
