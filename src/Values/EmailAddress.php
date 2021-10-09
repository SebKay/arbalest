<?php

namespace Arbalest\Values;

class EmailAddress
{
    protected string $emailAddress;

    public function __construct(string $emailAddress)
    {
        $this->emailAddress = $emailAddress;

        if (!\filter_var($this->emailAddress, \FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('The email address provided is invalid');
        }
    }

    public function get(): string
    {
        return $this->emailAddress;
    }

    public function __toString(): string
    {
        return $this->get();
    }
}
