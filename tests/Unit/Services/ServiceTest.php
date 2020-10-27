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

        $this->service = $this->getMockForAbstractClass('Arbalest\Services\Service', [['key' => 'value']]);
    }

    public function test_config_is_an_array()
    {
        $this->assertIsArray($this->service->getConfig());
    }
}
