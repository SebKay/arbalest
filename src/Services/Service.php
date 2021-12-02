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

    /**
     * @param array<string> $email_addresses
     */
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

    /**
     * @param array<string> $email_addresses
     */
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
     *
     * @param array<string> $params
     */
    protected function formatParamsForRequest(
        array $params
    ): array {
        return $params;
    }

    /**
     * Perform a GET request
     *
     * @param array<string> $params
     */
    protected function get(
        string $url,
        array $params = []
    ): \Psr\Http\Message\ResponseInterface {
        return $this->http->get($url, $this->formatParamsForRequest($params));
    }

    /**
     * Perform a POST request
     *
     * @param array<string> $params
     */
    protected function post(
        string $url,
        array $params = []
    ): \Psr\Http\Message\ResponseInterface {
        return $this->http->post($url, $this->formatParamsForRequest($params));
    }

    /**
     * Perform a PUT request
     *
     * @param array<string> $params
     */
    protected function put(
        string $url,
        array $params = []
    ): \Psr\Http\Message\ResponseInterface {
        return $this->http->put($url, $this->formatParamsForRequest($params));
    }

    /**
     * Convert an array of email string to value objects
     *
     * @param array<string> $email_addresses
     *
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
