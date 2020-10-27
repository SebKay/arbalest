<?php

namespace Arbalest;

interface SubscribableInterface
{
    public function subscribe(string $email_address): bool;

    public function unsubscribe(string $email_address): bool;
}
