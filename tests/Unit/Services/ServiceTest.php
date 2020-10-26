<?php

namespace Tests\Unit;

use Arbalest\Services\Mailchimp;

class ServiceTest extends Test
{
    /**
     * @var Mailchimp
     */
    protected $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = $this->getMockForAbstractClass('Arbalest\Services\Service', [['key' => 'value']]);
    }

    /**
     * @test
     */
    public function test_config_is_an_array()
    {
        $this->assertIsArray($this->service->getConfig());
    }
}
