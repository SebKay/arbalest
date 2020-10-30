<?php

namespace Tests\Unit\Services;

use \Tests\Unit\Test;

class ServiceTest extends Test
{
    /**
     * @var Arbalest\Services\Service
     */
    protected $service;

    public function setUp(): void
    {
        parent::setUp();

        $service_config = $this->getMockForAbstractClass(
            \Arbalest\Values\ServiceConfig::class,
            [
                [
                    'key' => 'value'
                ]
            ]
        );

        $this->service = $this->getMockForAbstractClass(
            \Arbalest\Services\Service::class,
            [
                $service_config
            ]
        );
    }

    /**
     * @test
     * @testdox It's config() method returns a ServiceConfig object
     */
    public function its_config_method_returns_a_ServiceConfig_object()
    {
        $this->assertInstanceOf(\Arbalest\Values\ServiceConfig::class, $this->service->config());
    }

    /**
     * @test
     * @testdox It can return an array with config()->get()
     */
    public function its_can_return_an_array()
    {
        $this->assertIsArray($this->service->config()->get());
    }
}
