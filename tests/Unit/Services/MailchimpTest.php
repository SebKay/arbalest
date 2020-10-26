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

        $this->mailchimp = $this->createMock(Mailchimp::class);
        $this->mailchimp
            ->method('checkConnection')
            ->willReturn(true);
    }

    /**
     * @test
     */
    public function test_connection_to_api_is_successful()
    {
        $this->assertTrue($this->mailchimp->checkConnection());
    }
}
