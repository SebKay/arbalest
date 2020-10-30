<?php

namespace Tests\Unit\Services;

use Arbalest\Values\MailchimpConfig;
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
            'Arbalest\Services\Service',
            [
                $service_config
            ]
        );
    }

    public function test_config_is_an_ServiceConfig_object()
    {
        $this->assertInstanceOf(\Arbalest\Values\ServiceConfig::class, $this->service->config());
    }

    public function test_config_is_an_array()
    {
        $this->assertIsArray($this->service->config()->get());
    }
}
