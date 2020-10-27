<?php

namespace Tests\Unit;

use Arbalest\Arbalest;
use Arbalest\Services\Mailchimp;
use Arbalest\Services\Service;

class ArbalestTest extends Test
{
    /**
     * @var Arbalest
     */
    protected $arbalest;

    public function setUp(): void
    {
        parent::setUp();

        $generic_service = $this->createMock(Service::class);
        $generic_service
            ->method('subscribe')
            ->willReturn(true);
        $generic_service
            ->method('unsubscribe')
            ->willReturn(true);

        $this->arbalest = new Arbalest($generic_service);
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
