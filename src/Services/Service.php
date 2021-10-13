<?php

namespace Arbalest\Services;

use Arbalest\Interfaces\Subscribable;
use Arbalest\Values\Configs\ServiceConfig;
use Arbalest\Values\EmailAddress;

abstract class Service implements Subscribable
{
    protected ServiceConfig $config;

    protected \GuzzleHttp\Client $http;

    public function __construct(
        ServiceConfig $config
    ) {
        $this->config = $config;
    }

    /**
     * Format JSON payload for requests
     */
    protected function formatParamsForRequest(
        array $params
    ): array {
        return $params;
    }

    /**
     * Perform a GET request
     */
    protected function get(
        string $url,
        array $params = []
    ): \Psr\Http\Message\ResponseInterface {
        return $this->http->get($url, $this->formatParamsForRequest($params));
    }

    /**
     * Perform a POST request
     */
    protected function post(
        string $url,
        array $params = []
    ): \Psr\Http\Message\ResponseInterface {
        return $this->http->post($url, $this->formatParamsForRequest($params));
    }

    /**
     * Perform a PUT request
     */
    protected function put(
        string $url,
        array $params = []
    ): \Psr\Http\Message\ResponseInterface {
        return $this->http->put($url, $this->formatParamsForRequest($params));
    }

    /**
     * Subscribe email address to list
     */
    abstract public function subscribe(
        EmailAddress $email_address
    ): bool;

    /**
     * Unsubscribe email address from list
     */
    abstract public function unsubscribe(
        EmailAddress $email_address
    ): bool;
}
