<?php

namespace Arbalest;

class GuzzleClientExceptionHandler
{
    /**
     * Handle the JSON reponse and throw an exception
     *
     * @param object $response
     */
    public static function response($response = null): void
    {
        if (!$response) {
            $error         = new \stdClass();
            $error->detail = 'Sorry, there was an unexpected error with the API.';
        } else {
            $error = json_decode($response->getBody()->getContents());
        }

        throw new \Exception($error->detail);
    }
}
