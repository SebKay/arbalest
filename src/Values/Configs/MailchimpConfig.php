<?php

declare(strict_types=1);

namespace Arbalest\Values\Configs;

class MailchimpConfig extends ServiceConfig
{
    protected array $requiredSettings = [
        'api_key',
        'server',
        'list_id',
    ];
}
