<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

abstract class Test extends TestCase
{
    public function setUp(): void
    {
        //---- Load environment variables
        \Dotenv\Dotenv::createImmutable(__DIR__, '../../.tests.env')->load();
    }
}
