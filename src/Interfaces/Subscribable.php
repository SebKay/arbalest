<?php

namespace Arbalest\Interfaces;

use Arbalest\Values\EmailAddress;

interface Subscribable
{
    public function subscribe(EmailAddress $email_address): bool;

    public function unsubscribe(EmailAddress $email_address): bool;
}
