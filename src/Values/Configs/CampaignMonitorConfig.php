<?php

namespace Arbalest\Values\Configs;

class CampaignMonitorConfig extends ServiceConfig
{
    protected array $requiredSettings = [
        'api_key',
        'list_id',
    ];
}
