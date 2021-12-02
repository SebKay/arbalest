<?php

declare(strict_types=1);

namespace Arbalest\Values\Configs;

class CampaignMonitorConfig extends ServiceConfig
{
    protected array $requiredSettings = [
        'api_key',
        'list_id',
    ];
}
