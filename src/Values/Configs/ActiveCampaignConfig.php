<?php

declare(strict_types=1);

namespace Arbalest\Values\Configs;

class ActiveCampaignConfig extends ServiceConfig
{
    /**
     * @var array<string>
     */
    protected array $requiredSettings = [
        'api_key',
        'account_url',
        'list_id',
    ];
}
