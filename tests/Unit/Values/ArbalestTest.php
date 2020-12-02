<?php

namespace Tests\Unit;

use Arbalest\Arbalest;
use Arbalest\Values\MailchimpConfig;

class ArbalestTest extends Test
{
    /**
     * @var \Arbalest\Arbalest
     */
    protected $arbalest;

    public function setUp(): void
    {
        parent::setUp();

        $mc_list_mock = $this->getMockBuilder(\Arbalest\Services\MailchimpList::class)
            ->setConstructorArgs([
                new MailchimpConfig([
                    'apiKey'  => 'test',
                    'server'  => 'test',
                    'list_id' => 'test',
                ])
            ])
            ->getMock();

        $mc_list_mock->method('subscribe')
            ->willReturn(true);

        $mc_list_mock->method('unsubscribe')
            ->willReturn(true);

        /**
         * @var \Arbalest\Services\MailchimpList
         */
        $mc_list = $mc_list_mock;

        $this->arbalest = new Arbalest($mc_list);
    }

    /**
     * @test
     */
    public function its_subscribe_method_returns_true()
    {
        $this->assertTrue($this->arbalest->subscribe('test@test.com'));
    }

    /**
     * @test
     */
    public function its_unsubscribe_method_returns_true()
    {
        $this->assertTrue($this->arbalest->unsubscribe('test@test.com'));
    }

    /**
     * @test
     */
    public function its_subscribe_method_throws_an_error_for_an_invalid_email()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->assertTrue($this->arbalest->subscribe('test'));
    }

    /**
     * @test
     */
    public function its_unsubscribe_method_throws_an_error_for_an_invalid_email()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->assertTrue($this->arbalest->unsubscribe('test'));
    }
}
