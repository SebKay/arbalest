<?php

declare(strict_types=1);

namespace Arbalest\Values;

class HubSpotContact
{
    protected int $id;
    public EmailAddress $email;
    public string $firstName = '';
    public string $lastName  = '';

    public function __construct(
        object $data
    ) {
        $this->email     = new EmailAddress($data->properties->email ?? '');
        $this->firstName = $data->properties->firstname ?? '';
        $this->lastName  = $data->properties->lastname ?? '';
    }
}
