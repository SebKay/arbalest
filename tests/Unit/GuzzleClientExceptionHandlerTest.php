<?php

namespace Tests\Unit;

use Arbalest\GuzzleClientExceptionHandler;

class GuzzleClientExceptionHandlerTest extends Test
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_error_is_throw_without_response()
    {
        $this->expectException('\Exception');

        GuzzleClientExceptionHandler::response();
    }
}
