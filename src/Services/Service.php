<?php

declare(strict_types=1);

namespace Arbalest\Services;

use Arbalest\Interfaces\Subscribable;
use Arbalest\Values\Configs\ServiceConfig;
use Arbalest\Values\EmailAddress;
use Psr\Http\Message\ResponseInterface;

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
     * @param array<string> $emails
     */
    public function subscribeAll(
        array $emails
    ): bool {
        foreach ($this->convertArrayOfEmailAddresses($emails) as $email) {
            $this->subscribe($email);
        }

        return true;
    }

    /**
     * @param array<string> $emails
     */
    public function unsubscribeAll(
        array $emails
    ): bool {
        foreach ($this->convertArrayOfEmailAddresses($emails) as $email) {
            $this->unsubscribe($email);
        }

        return true;
    }

    /**
     * Format JSON payload for requests
     *
     * @param array<string> $params
     *
     * @return array<string>
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
    ): ResponseInterface {
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
    ): ResponseInterface {
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
    ): ResponseInterface {
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
