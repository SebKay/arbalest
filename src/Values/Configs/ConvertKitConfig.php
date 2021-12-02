<?php

declare(strict_types=1);

namespace Arbalest\Values\Configs;

class ConvertKitConfig extends ServiceConfig
{
    /**
     * @var array<string>
     */
    protected array $requiredSettings = [
        'api_key',
        'api_secret',
        'form_id',
    ];
}
