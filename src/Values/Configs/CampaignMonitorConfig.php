<?php

declare(strict_types=1);

namespace Arbalest\Values\Configs;

class CampaignMonitorConfig extends ServiceConfig
{
    /**
     * @var array<string>
     */
    protected array $requiredSettings = [
        'api_key',
        'list_id',
    ];
}
