<?php

namespace Arbalest\Values\Configs;

class ConvertKitConfig extends ServiceConfig
{
    protected array $requiredSettings = [
        'api_key',
        'api_secret',
        'form_id',
    ];
}
