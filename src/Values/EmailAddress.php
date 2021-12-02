<?php

declare(strict_types=1);

namespace Arbalest\Values;

class EmailAddress
{
    protected string $value;

    public function __construct(
        string $value
    ) {
        $this->value = $value;

        if (! \filter_var($this->value, \FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(
                'The email address provided is invalid'
            );
        }
    }

    public function __toString(): string
    {
        return $this->get();
    }

    public function get(): string
    {
        return $this->value;
    }
}
