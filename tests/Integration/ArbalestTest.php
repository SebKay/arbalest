<?php

namespace ArbalestTests\Integration;

use Arbalest\Arbalest;
use Arbalest\Services\Service;
use ArbalestTests\Test;

class ArbalestTest extends Test
{
    protected Arbalest $app;

    public function setUp(): void
    {
        parent::setUp();

        /**
         * @var Service|\PHPUnit\Framework\MockObject\Stub
         */
        $service_mock = $this->createStub(Service::class);

        $service_mock
            ->method('subscribe')
            ->willReturn(true);

        $service_mock
            ->method('unsubscribe')
            ->willReturn(true);

        $this->app = new Arbalest($service_mock);
    }

    /**
     * @test
     */
    public function it_return_a_boolean_on_subscribe()
    {
        $this->assertIsBool($this->app->subscribe($this->faker->email));
    }

    /**
     * @test
     */
    public function it_return_a_boolean_on_unsubscribe()
    {
        $this->assertIsBool($this->app->unsubscribe($this->faker->email));
    }

    /**
     * @test
     */
    public function it_return_a_boolean_on_subscribe_all()
    {
        $this->assertIsBool($this->app->subscribeAll([
            $this->faker->email,
            $this->faker->email,
            $this->faker->email,
        ]));
    }

    /**
     * @test
     */
    public function it_return_a_boolean_on_unsubscribe_all()
    {
        $this->assertIsBool($this->app->unsubscribeAll([
            $this->faker->email,
            $this->faker->email,
            $this->faker->email,
        ]));
    }
}
