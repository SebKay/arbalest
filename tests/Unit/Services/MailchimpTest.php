<?php

namespace ArbalestTests\Unit\Services;

use Arbalest\Services\Mailchimp;
use ArbalestTests\Unit\Test;

class MailchimpTest extends Test
{
    /**
     * @test
     */
    public function it_can_hash_an_email_address()
    {
        $this->assertSame('b642b4217b34b1e8d3bd915fc65c4452', Mailchimp::subscriberHash('test@test.com'));
    }
}
