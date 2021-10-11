<?php

namespace Arbalest\Services;

use Arbalest\Values\ConvertKitConfig;
use Arbalest\Values\EmailAddress;

class ConvertKit extends Service
{
    protected string $apiKey;
    protected string $apiSecret;
    protected string $formID;

    protected \GuzzleHttp\Client $http;

    public function __construct(
        array $config
    ) {
        parent::__construct(new ConvertKitConfig($config));

        $this->apiKey    = $this->config->get('api_key');
        $this->apiSecret = $this->config->get('api_secret');
        $this->formID    = $this->config->get('form_id');

        $this->http = new \GuzzleHttp\Client([
            'base_uri' => "https://api.convertkit.com/v3/",
        ]);
    }

    /**
     * Format JSON payload for requests
     */
    protected function formatParamsForRequest(
        array $params
    ): array {
        return \array_merge_recursive([
            'json' => [
                'api_key' => $this->apiKey,
            ],
        ], $params);
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

    public function subscribe(
        EmailAddress $email_address
    ): bool {
        try {
            $response = $this->post("forms/{$this->formID}/subscribe", [
                'json' => [
                    'email' => $email_address->get(),
                ],
            ]);

            return $response->getStatusCode() == 200 ? true : false;
        } catch (\Exception $e) {
            throw new \Exception('There was an error subscribing that email address.', (int) $e->getCode());
        }
    }

    public function unsubscribe(
        EmailAddress $email_address
    ): bool {
        try {
            $response = $this->put("unsubscribe", [
                'json' => [
                    'api_secret' => $this->apiSecret,
                    'email'      => $email_address->get(),
                ],
            ]);

            return $response->getStatusCode() == 200 ? true : false;
        } catch (\Exception $e) {
            throw new \Exception('There was an error unsubscribing that email address.', (int) $e->getCode());
        }
    }
}
