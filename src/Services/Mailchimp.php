<?php

namespace Arbalest\Services;

use Arbalest\Values\EmailAddress;
use Arbalest\Values\MailchimpConfig;

class Mailchimp extends Service
{
    protected string $list_id;

    public function __construct(array $config)
    {
        parent::__construct(new MailchimpConfig($config));

        $this->list_id = $this->config->get('list_id');
    }

    /**
     * Subscribe email address to list
     */
    public function subscribe(EmailAddress $email_address): bool
    {
        return true;
    }

    /**
     * Unsubscribe email address from list
     */
    public function unsubscribe(EmailAddress $email_address): bool
    {
        return true;
    }
}
