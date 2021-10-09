<?php

namespace ArbalestTests\Unit;

use Arbalest\Values\EmailAddress;

class EmailAddressTest extends Test
{
    /**
     * @var string
     */
    protected $email;

    /**
     * @var EmailAddress
     */
    protected $EmailAddress;

    public function setUp(): void
    {
        parent::setUp();

        $this->email        = $this->faker->email;
        $this->EmailAddress = new EmailAddress($this->email);
    }

    /**
     * @test
     * @testdox It's __toString() method returns the email address
     */
    public function its_toString_method_returns_the_email_address()
    {
        $this->assertSame($this->email, (string) $this->EmailAddress);
    }

    /**
     * @test
     * @testdox It's get() method returns the email address
     */
    public function its_get_method_returns_the_email_address()
    {
        $this->assertSame($this->email, $this->EmailAddress->get());
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
