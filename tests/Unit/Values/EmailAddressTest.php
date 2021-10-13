<?php

namespace ArbalestTests\Unit\Values;

use Arbalest\Values\EmailAddress;
use ArbalestTests\Test;

class EmailAddressTest extends Test
{
    protected string $email;
    protected EmailAddress $EmailAddress;

    public function setUp(): void
    {
        parent::setUp();

        $this->email        = $this->faker->email;
        $this->EmailAddress = new EmailAddress($this->email);
    }

    /**
     * @test
     */
    public function it_returns_the_correct_value()
    {
        $this->assertSame($this->email, $this->EmailAddress->get());
    }

    /**
     * @test
     */
    public function it_returns_the_correct_value_when_called_as_a_string()
    {
        $this->assertSame($this->email, (string) $this->EmailAddress);
    }

    /**
     * @test
     */
    public function it_throws_an_error_for_an_invalid_email_address()
    {
        $this->expectException(\InvalidArgumentException::class);

        new EmailAddress('test');
    }
}
