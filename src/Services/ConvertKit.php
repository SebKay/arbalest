<?php

declare(strict_types=1);

namespace Arbalest\Services;

use Arbalest\Values\Configs\ConvertKitConfig;
use Arbalest\Values\EmailAddress;

class ConvertKit extends Service
{
    protected string $apiKey;
    protected string $apiSecret;
    protected string $formID;

    public function __construct(
        array $config
    ) {
        parent::__construct(new ConvertKitConfig($config));

        $this->apiKey = $this->config->get('api_key');
        $this->apiSecret = $this->config->get('api_secret');
        $this->formID = $this->config->get('form_id');

        $this->http = new \GuzzleHttp\Client([
            'base_uri' => 'https://api.convertkit.com/v3/',
        ]);
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

            return $response->getStatusCode() === 200 ? true : false;
        } catch (\Exception $e) {
            throw new \Exception('There was an error subscribing that email address.', (int) $e->getCode());
        }
    }

    public function unsubscribe(
        EmailAddress $email_address
    ): bool {
        try {
            $response = $this->put('unsubscribe', [
                'json' => [
                    'api_secret' => $this->apiSecret,
                    'email' => $email_address->get(),
                ],
            ]);

            return $response->getStatusCode() === 200 ? true : false;
        } catch (\Exception $e) {
            throw new \Exception('There was an error unsubscribing that email address.', (int) $e->getCode());
        }
    }

    protected function formatParamsForRequest(
        array $params
    ): array {
        return \array_merge_recursive([
            'json' => [
                'api_key' => $this->apiKey,
            ],
        ], $params);
    }
}
