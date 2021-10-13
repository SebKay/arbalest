<?php

namespace ArbalestTests\Unit\Values;

use Arbalest\Values\Configs\MailchimpConfig;
use ArbalestTests\Unit\Test;

class MailchimpConfigTest extends Test
{
    /**
     * @test
     */
    public function it_throws_an_error_with_no_api_key()
    {
        $this->expectException(\InvalidArgumentException::class);

        new MailchimpConfig([
            'server'  => 'test',
            'list_id' => 'test',
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_error_with_no_server()
    {
        $this->expectException(\InvalidArgumentException::class);

        new MailchimpConfig([
            'api_key'  => 'test',
            'list_id'  => 'test',
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_error_with_no_list_id()
    {
        $this->expectException(\InvalidArgumentException::class);

        new MailchimpConfig([
            'api_key' => 'test',
            'server'  => 'test',
        ]);
    }

    /**
     * @test
     */
    public function it_returns_the_correct_settings()
    {
        $settings = [
            'api_key' => 'test_api_key',
            'server'  => 'test_server',
            'list_id' => 'test_list_id',
        ];

        $config = new MailchimpConfig($settings);

        $this->assertSame($settings['api_key'], $config->get('api_key'));
        $this->assertSame($settings['server'], $config->get('server'));
        $this->assertSame($settings['list_id'], $config->get('list_id'));
    }
}
