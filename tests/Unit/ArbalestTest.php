<?php

namespace Tests\Unit;

use Arbalest\Arbalest;
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
     * @testdox It's subscribe() method returns true
     */
    public function its_subscribe_method_returns_true()
    {
        $this->assertTrue($this->arbalest->subscribe('test@test.com'));
    }

    /**
     * @test
     * @testdox It's unsubscribe() method returns true
     */
    public function its_unsubscribe_method_returns_true()
    {
        $this->assertTrue($this->arbalest->unsubscribe('test@test.com'));
    }
}
