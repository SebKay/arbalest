<?php

namespace Tests\Unit;

use Arbalest\Values\EmailAddress;

class EmailAddressTest extends Test
{
    /**
     * @var EmailAddress
     */
    protected $email_address;

    public function setUp(): void
    {
        parent::setUp();

        $this->email_address = new EmailAddress($this->faker->email);
    }

    /**
     * @test
     * @testdox It's __toString() method retuns a string
     */
    public function its_toString_returns_a_string()
    {
        $this->assertIsString((string) $this->email_address);
    }

    /**
     * @test
     * @testdox It's get() method returns a string
     */
    public function its_get_method_returns_a_string()
    {
        $this->assertIsString($this->email_address->get());
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
