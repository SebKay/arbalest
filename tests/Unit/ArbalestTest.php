<?php

namespace Tests\Unit;

use Arbalest\Arbalest;
use Arbalest\Services\Mailchimp;

class ArbalestTest extends Test
{
    /**
     * @var Arbalest
     */
    protected $arbalest;

    public function setUp(): void
    {
        parent::setUp();

        $mailchimp = $this->createMock(Mailchimp::class);
        $mailchimp
            ->method('checkConnection')
            ->willReturn(true);

        $this->arbalest = new Arbalest($mailchimp);
    }

    /**
     * @test
     */
    public function test_subscribe_returns_true()
    {
        $this->assertTrue($this->arbalest->subscribe('test@test.com'));
    }

    /**
     * @test
     */
    public function test_unsubscribe_returns_true()
    {
        $this->assertTrue($this->arbalest->unsubscribe('test@test.com'));
    }
}
