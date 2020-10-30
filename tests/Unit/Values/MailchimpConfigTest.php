<?php

namespace Tests\Unit;

use Arbalest\Values\MailchimpConfig;

class MailchimpConfigTest extends Test
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     * @testdox It's get() method returns an array
     */
    public function its_get_method_returns_an_array()
    {
        $mc_config = new MailchimpConfig([
            'apiKey'  => 'test',
            'server'  => 'test',
            'list_id' => 'test',
        ]);

        $this->assertIsArray($mc_config->get());
    }

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
}
