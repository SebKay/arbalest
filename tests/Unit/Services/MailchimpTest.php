<?php

namespace Tests\Unit\Services;

use Arbalest\Services\Mailchimp;
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

        $this->mailchimp_service = new Mailchimp([
            'apiKey' => $_ENV['MAILCHIMP_API_KEY'],
            'server' => $_ENV['MAILCHIMP_SERVER']
        ], $_ENV['MAILCHIMP_LIST_ID']);
    }

    public function test_connection_can_be_established()
    {
        $this->assertTrue($this->mailchimp_service->checkConnection());
    }

    public function test_subscribe_is_successful()
    {
        $email = $this->faker->email;

        $this->assertTrue($this->mailchimp_service->subscribe($email));

        return $email;
    }

    /**
     * @depends test_subscribe_is_successful
     */
    public function test_subscribe_throws_error_when_already_subscribed(string $email)
    {
        $this->expectException('\Exception');

        $this->mailchimp_service->subscribe($email);
    }

    /**
     * @depends test_subscribe_is_successful
     */
    public function test_unsubscribe_returns_true(string $email)
    {
        $this->assertTrue($this->mailchimp_service->unsubscribe($email));
    }

    /**
     * @depends test_subscribe_is_successful
     */
    public function test_unsubscribe_throws_error_when_already_unsubscribed(string $email)
    {
        $this->expectException('\Exception');

        $this->mailchimp_service->unsubscribe($email);
    }
}
