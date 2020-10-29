<?php

namespace Arbalest\Services;

use MailchimpMarketing\Api\ListsApi;
use MailchimpMarketing\Api\PingApi;

class Mailchimp extends Service
{
    /**
     * @var \MailchimpMarketing\Configuration
     */
    protected $service;

    /**
     * @var \MailchimpMarketing\Api\ListsApi
     */
    protected $lists_api;

    /**
     * @var string
     */
    protected $list_id;

    public function __construct(array $config, string $list_id)
    {
        $this->config = $config;

        $this->list_id = $list_id;

        $this->service = new \MailchimpMarketing\ApiClient();
        $this->service->setConfig($this->getConfig());

        $this->lists_api = new ListsApi($this->service);
    }

    /**
     * Ping Mailchimp service
     *
     * @return boolean
     */
    public function checkConnection(): bool
    {
        $ping = new PingApi($this->service);

        return ($ping->get() ? true : false);
    }

    /**
     * Subscribe user to a list
     *
     * @param string $email_address
     * @return bool
     */
    public function subscribe(string $email_address): bool
    {
        try {
            $this->lists_api->addListMember($this->list_id, [
                'status'        => 'subscribed',
                'email_address' => $email_address
            ]);

            return true;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Unsubscribe user from a list
     *
     * @param string $email_address
     * @return bool
     */
    public function unsubscribe(string $email_address): bool
    {
        $subscriber_hash = strtolower(
            md5($email_address)
        );

        try {
            $this->lists_api->deleteListMemberWithHttpInfo($this->list_id, $subscriber_hash);

            return true;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
