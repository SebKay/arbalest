<?php

namespace ArbalestTests\Unit\Values;

use Arbalest\Values\Configs\ConvertKitConfig;
use ArbalestTests\Test;

class ConvertKitConfigTest extends Test
{
    /**
     * @test
     */
    public function it_throws_an_error_with_no_api_key()
    {
        $this->expectException(\InvalidArgumentException::class);

        new ConvertKitConfig([
            'api_secret' => 'test',
            'form_id'    => 'test',
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_error_with_no_api_secret()
    {
        $this->expectException(\InvalidArgumentException::class);

        new ConvertKitConfig([
            'api_key' => 'test',
            'form_id' => 'test',
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_error_with_no_form_id()
    {
        $this->expectException(\InvalidArgumentException::class);

        new ConvertKitConfig([
            'api_key'    => 'test',
            'api_secret' => 'test',
        ]);
    }

    /**
     * @test
     */
    public function it_returns_the_correct_settings()
    {
        $settings = [
            'api_key'    => 'test_api_key',
            'api_secret' => 'test_api_secret',
            'form_id'    => 'test_form_id',
        ];

        $config = new ConvertKitConfig($settings);

        $this->assertSame($settings['api_key'], $config->get('api_key'));
        $this->assertSame($settings['api_secret'], $config->get('api_secret'));
        $this->assertSame($settings['form_id'], $config->get('form_id'));
    }
}
