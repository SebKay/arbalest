<?php

namespace ArbalestTests\Unit;

use PHPUnit\Framework\TestCase;

abstract class Test extends TestCase
{
    protected \Faker\Generator $faker;

    public function setUp(): void
    {
        //---- Load environment variables
        \Dotenv\Dotenv::createImmutable(__DIR__, '../../.tests.env')->load();

        //---- Create new Faker object
        $this->faker = \Faker\Factory::create();
    }
}
