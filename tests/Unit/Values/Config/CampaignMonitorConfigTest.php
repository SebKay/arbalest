<?php

namespace ArbalestTests\Unit\Values;

use Arbalest\Values\Configs\CampaignMonitorConfig;
use ArbalestTests\Test;

class CampaignMonitorConfigTest extends Test
{
    /**
     * @test
     */
    public function it_throws_an_error_with_no_api_key()
    {
        $this->expectException(\InvalidArgumentException::class);

        new CampaignMonitorConfig([
            'account_url' => 'test',
            'list_id'     => 'test',
        ]);
    }

    /**
     * @test
     */
    public function it_throws_an_error_with_no_list_id()
    {
        $this->expectException(\InvalidArgumentException::class);

        new CampaignMonitorConfig([
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
            'api_key' => 'test_api_key',
            'list_id' => 'test_list_id',
        ];

        $config = new CampaignMonitorConfig($settings);

        $this->assertSame($settings['api_key'], $config->get('api_key'));
        $this->assertSame($settings['list_id'], $config->get('list_id'));
    }
}
