<?php

namespace Arbalest\Interfaces;

interface Subscribable
{
    public function subscribe(string $email_address): bool;

    public function unsubscribe(string $email_address): bool;
}
