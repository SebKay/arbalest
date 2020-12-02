<?php

namespace Tests\Unit;

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
            'apiKey'  => 'test',
            'server'  => 'test',
            'list_id' => 'test',
        ];

        $config = new MailchimpConfig($data);

        $this->assertSame($data, $config->get());
    }
}
