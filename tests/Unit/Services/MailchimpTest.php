<?php

namespace Tests\Unit\Services;

use Arbalest\Services\Mailchimp;
use Arbalest\Values\EmailAddress;
use Arbalest\Values\MailchimpConfig;
use \Tests\Unit\Test;

class MailchimpTest extends Test
{
    /**
     * @var Mailchimp
     */
    protected $mailchimp_service;

    public function setUp(): void
    {
        parent::setUp();

        $this->mailchimp_service = new Mailchimp(
            new MailchimpConfig([
                'apiKey'  => $_ENV['MAILCHIMP_API_KEY'],
                'server'  => $_ENV['MAILCHIMP_SERVER'],
                'list_id' => $_ENV['MAILCHIMP_LIST_ID']
            ])
        );
    }

    public function test_connection_can_be_established()
    {
        $this->assertTrue($this->mailchimp_service->checkConnection());
    }

    public function test_subscribe_is_successful()
    {
        $email = new EmailAddress($this->faker->email);

        $this->assertTrue($this->mailchimp_service->subscribe($email));

        return $email;
    }

    /**
     * @depends test_subscribe_is_successful
     */
    public function test_subscribe_throws_error_when_already_subscribed(EmailAddress $email)
    {
        $this->expectException('\Exception');

        $this->mailchimp_service->subscribe($email);
    }

    /**
     * @depends test_subscribe_is_successful
     */
    public function test_unsubscribe_returns_true(EmailAddress $email)
    {
        $this->assertTrue($this->mailchimp_service->unsubscribe($email));
    }

    /**
     * @depends test_subscribe_is_successful
     */
    public function test_unsubscribe_throws_error_when_already_unsubscribed(EmailAddress $email)
    {
        $this->expectException('\Exception');

        $this->mailchimp_service->unsubscribe($email);
    }
}
