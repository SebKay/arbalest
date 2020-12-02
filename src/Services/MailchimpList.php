<?php

namespace Arbalest\Services;

use Arbalest\Values\EmailAddress;
use Arbalest\Values\MailchimpConfig;
use MailchimpMarketing\Api\ListsApi;
use MailchimpMarketing\Api\PingApi;

class MailchimpList extends Service
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

    /**
     * @codeCoverageIgnore
     */
    public function __construct(MailchimpConfig $config)
    {
        $this->config = $config;

        $this->list_id = $this->config->get()['list_id'];

        $this->service = new \MailchimpMarketing\ApiClient();
        $this->service->setConfig($this->config()->get());

        $this->lists_api = new ListsApi($this->service);
    }

    /**
     * Ping Mailchimp service
     *
     * @return boolean
     * @codeCoverageIgnore
     */
    public function checkConnection(): bool
    {
        $ping = new PingApi($this->service);

        return ($ping->get() ? true : false);
    }

    /**
     * Subscribe user to a list
     *
     * @param EmailAddress $email_address
     * @return bool
     * @codeCoverageIgnore
     */
    public function subscribe(EmailAddress $email_address): bool
    {
        try {
            $this->lists_api->addListMember($this->list_id, [
                'status'        => 'subscribed',
                'email_address' => $email_address->get()
            ]);

            return true;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Unsubscribe user from a list
     *
     * @param EmailAddress $email_address
     * @return bool
     * @codeCoverageIgnore
     */
    public function unsubscribe(EmailAddress $email_address): bool
    {
        $subscriber_hash = strtolower(
            md5($email_address->get())
        );

        try {
            $this->lists_api->deleteListMember($this->list_id, $subscriber_hash);

            return true;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
