<?php

namespace ArbalestTests;

use PHPUnit\Framework\TestCase;

abstract class Test extends TestCase
{
    protected \Faker\Generator $faker;

    public function setUp(): void
    {
        $this->faker = \Faker\Factory::create();
    }
}
