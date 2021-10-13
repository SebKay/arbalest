<?php

namespace ArbalestTests\Unit\Values;

use Arbalest\Values\Configs\ActiveCampaignConfig;
use ArbalestTests\Test;

class ActiveCampaignConfigTest extends Test
{
    /**
     * @test
     */
    public function it_throws_an_error_with_no_api_key()
    {
        $this->expectException(\InvalidArgumentException::class);

        new ActiveCampaignConfig([
            'account_url' => 'test',
            'list_id'     => 'test',
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_error_with_no_account_url()
    {
        $this->expectException(\InvalidArgumentException::class);

        new ActiveCampaignConfig([
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

        new ActiveCampaignConfig([
            'api_key'     => 'test',
            'account_url' => 'test',
        ]);
    }

    /**
     * @test
     */
    public function it_returns_the_correct_settings()
    {
        $settings = [
            'api_key'     => 'test_api_key',
            'account_url' => 'test_server',
            'list_id'     => 'test_list_id',
        ];

        $config = new ActiveCampaignConfig($settings);

        $this->assertSame($settings['api_key'], $config->get('api_key'));
        $this->assertSame($settings['account_url'], $config->get('account_url'));
        $this->assertSame($settings['list_id'], $config->get('list_id'));
    }
}
