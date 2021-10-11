<?php

namespace ArbalestTests\Unit;

use PHPUnit\Framework\TestCase;

abstract class Test extends TestCase
{
    protected \Faker\Generator $faker;

    public function setUp(): void
    {
        //---- Create new Faker object
        $this->faker = \Faker\Factory::create();
    }
}
