<?php

namespace Arbalest\Values\Configs;

class ActiveCampaignConfig extends ServiceConfig
{
    protected array $requiredSettings = [
        'api_key',
        'account_url',
        'list_id',
    ];
}
