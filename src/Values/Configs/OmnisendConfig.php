<?php

declare(strict_types=1);

namespace Arbalest\Values\Configs;

class OmnisendConfig extends ServiceConfig
{
    protected array $requiredSettings = [
        'api_key',
    ];
}
