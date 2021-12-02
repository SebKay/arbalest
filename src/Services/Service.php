<?php

declare(strict_types=1);

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

    public function subscribeAll(
        array $email_addresses
    ): bool {
        $success = false;

        foreach ($this->convertArrayOfEmailAddresses($email_addresses) as $email_address) {
            if ($this->subscribe($email_address)) {
                $success = true;
            } else {
                $success = false;
            }
        }

        return $success;
    }

    public function unsubscribeAll(
        array $email_addresses
    ): bool {
        $success = false;

        foreach ($this->convertArrayOfEmailAddresses($email_addresses) as $email_address) {
            if ($this->unsubscribe($email_address)) {
                $success = true;
            } else {
                $success = false;
            }
        }

        return $success;
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
     * @return array<EmailAddress>
     */
    protected function convertArrayOfEmailAddresses(
        array $email_addresses
    ): array {
        return \array_map(static function ($email_address) {
            return new EmailAddress($email_address);
        }, $email_addresses);
    }
}
