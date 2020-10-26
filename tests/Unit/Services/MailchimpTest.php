<?php

namespace Tests\Unit\Services;

use \Tests\Unit\Test;
use Arbalest\Services\Mailchimp;

class MailchimpTest extends Test
{
    /**
     * @var Mailchimp
     */
    protected $mailchimp;

    public function setUp(): void
    {
        parent::setUp();

        $this->mailchimp = new Mailchimp([
            'apiKey' => $_ENV['MAILCHIMP_API_KEY'],
            'server' => $_ENV['MAILCHIMP_SERVER']
        ]);
    }

    /**
     * @test
     */
    public function test_connection_to_api_is_successful()
    {
        $this->assertTrue($this->mailchimp->checkConnection());
    }
}