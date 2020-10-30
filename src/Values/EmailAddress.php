<?php

namespace Arbalest\Values;

use Arbalest\Interfaces\ValueObject;

class EmailAddress implements ValueObject
{
    /**
     * @var string
     */
    protected $value;

    public function __construct(string $value)
    {
        $this->value = $value;

        if (!\filter_var($this->value, \FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('The email address provided is invalid');
        }
    }

    /**
     * Get email address value
     *
     * @return string
     */
    public function get(): string
    {
        return $this->value;
    }

    /**
     * Allow object to be output as string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->get();
    }
}
