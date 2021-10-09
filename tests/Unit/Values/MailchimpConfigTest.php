<?php

namespace ArbalestTests\Unit;

use Arbalest\Values\MailchimpConfig;

class MailchimpConfigTest extends Test
{
    /**
     * @test
     */
    public function it_throws_an_error_with_no_API_key()
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
            'apiKey'  => 'test',
            'list_id' => 'test',
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_error_with_no_list_id()
    {
        $this->expectException(\InvalidArgumentException::class);

        new MailchimpConfig([
            'apiKey' => 'test',
            'server' => 'test',
        ]);
    }

    /**
     * @test
     */
    public function its_get_method_returns_the_correct_data()
    {
        $data = [
            'apiKey'  => 'test_api_key',
            'server'  => 'test_server',
            'list_id' => 'test_list_id',
        ];

        $config = new MailchimpConfig($data);

        $this->assertSame('test_api_key', $config->get('apiKey'));
        $this->assertSame('test_server', $config->get('server'));
        $this->assertSame('test_list_id', $config->get('list_id'));
    }
}
