<?php

namespace Tests\Unit;

use Mockery;
use PHPUnit\Framework\TestCase;

abstract class Test extends TestCase
{
    /**
     * @var \Faker\Generator
     */
    protected $faker;

    public function setUp(): void
    {
        //---- Load environment variables
        \Dotenv\Dotenv::createImmutable(__DIR__, '../../.tests.env')->load();

        //---- Create new Faker object
        $this->faker = \Faker\Factory::create();
    }

    public function tearDown(): void {
        Mockery::close();
    }
}
