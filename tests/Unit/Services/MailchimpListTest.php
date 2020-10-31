<?php

namespace Tests\Unit\Services;

use Arbalest\Services\Mailchimp;
use Arbalest\Services\MailchimpList;
use Arbalest\Values\EmailAddress;
use Arbalest\Values\MailchimpConfig;
use \Tests\Unit\Test;

class MailchimpListTest extends Test
{
    /**
     * @var Mailchimp
     */
    protected $mailchimp_service;

    public function setUp(): void
    {
        parent::setUp();

        $this->mailchimp_service = new MailchimpList(
            new MailchimpConfig([
                'apiKey'  => $_ENV['MAILCHIMP_API_KEY'],
                'server'  => $_ENV['MAILCHIMP_SERVER'],
                'list_id' => $_ENV['MAILCHIMP_LIST_ID']
            ])
        );
    }

    /**
     * @test
     * @testdox It's connection to the API was successful
     */
    public function its_connection_to_the_api_worked()
    {
        $this->assertTrue($this->mailchimp_service->checkConnection());
    }

    /**
     * @test
     * @testdox It's subscribe() method returns true
     */
    public function its_subscribe_method_returns_true()
    {
        $email = new EmailAddress($this->faker->email);

        $this->assertTrue($this->mailchimp_service->subscribe($email));

        return $email;
    }

    /**
     * @test
     * @depends its_subscribe_method_returns_true
     * @testdox It throws an error when email address is already subscribed
     */
    public function it_throws_error_when_already_subscribed(EmailAddress $email)
    {
        $this->expectException('\Exception');

        $this->mailchimp_service->subscribe($email);
    }

    /**
     * @test
     * @depends its_subscribe_method_returns_true
     * @testdox It's unsubscribe() method returns true
     */
    public function its_unsubscribe_method_returns_true(EmailAddress $email)
    {
        $this->assertTrue($this->mailchimp_service->unsubscribe($email));
    }

    /**
     * @test
     * @depends its_subscribe_method_returns_true
     * @testdox It throws an error when email address is already unsubscribed
     */
    public function it_throws_error_when_already_unsubscribed(EmailAddress $email)
    {
        $this->expectException('\Exception');

        $this->mailchimp_service->unsubscribe($email);
    }
}
