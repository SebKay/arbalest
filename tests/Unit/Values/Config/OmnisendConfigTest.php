<?php

namespace ArbalestTests\Unit\Values;

use Arbalest\Values\Configs\OmnisendConfig;
use ArbalestTests\Test;

class OmnisendConfigTest extends Test
{
    /**
     * @test
     */
    public function it_throws_an_error_with_no_api_key()
    {
        $this->expectException(\InvalidArgumentException::class);

        new OmnisendConfig([]);
    }

    /**
     * @test
     */
    public function it_returns_the_correct_settings()
    {
        $settings = [
            'api_key' => 'test_api_key',
        ];

        $config = new OmnisendConfig($settings);

        $this->assertSame($settings['api_key'], $config->get('api_key'));
    }
}
