<?php

declare(strict_types=1);

namespace Arbalest\Values\Configs;

class HubSpotConfig extends ServiceConfig
{
    /**
     * @var array<string>
     */
    protected array $requiredSettings = [
        'api_key',
    ];
}
