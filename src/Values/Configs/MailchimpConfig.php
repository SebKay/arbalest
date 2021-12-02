<?php

declare(strict_types=1);

namespace Arbalest\Values\Configs;

class MailchimpConfig extends ServiceConfig
{
    /**
     * @var array<string>
     */
    protected array $requiredSettings = [
        'api_key',
        'server',
        'list_id',
    ];
}
