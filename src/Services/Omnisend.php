<?php

declare(strict_types=1);

namespace Arbalest\Services;

use Arbalest\Values\Configs\OmnisendConfig;
use Arbalest\Values\EmailAddress;

class Omnisend extends Service
{
    protected string $apiKey;

    /**
     * @param array<string> $config
     */
    public function __construct(
        array $config
    ) {
        parent::__construct(new OmnisendConfig($config));

        $this->apiKey = $this->config->get('api_key');

        $this->http = new \GuzzleHttp\Client([
            'base_uri' => 'https://api.omnisend.com/v3/',
            'headers'  => [
                'X-API-KEY' => $this->apiKey,
            ],
        ]);
    }

    public function subscribe(
        EmailAddress $email
    ): bool {
        try {
            $response = $this->post('contacts', [
                'json' => $this->arrayForEmailContact($email, true),
            ]);

            return $response->getStatusCode() === 200;
        } catch (\Exception $e) {
            throw new \Exception(
                'There was an error subscribing that email address.',
                (int) $e->getCode()
            );
        }
    }

    public function unsubscribe(
        EmailAddress $email
    ): bool {
        try {
            $response = $this->post('contacts', [
                'json' => $this->arrayForEmailContact($email, false),
            ]);

            return $response->getStatusCode() === 200;
        } catch (\Exception $e) {
            throw new \Exception(
                'There was an error unsubscribing that email address.',
                (int) $e->getCode()
            );
        }
    }

    /**
     * Create an array for adding/updating an email contact
     *
     * @return array<string>
     */
    protected function arrayForEmailContact(
        EmailAddress $email,
        bool $subscribed
    ): array {
        $status = $subscribed === true ? 'subscribed' : 'unsubscribed';

        return [
            'identifiers' => [
                [
                    'type'     => 'email',
                    'id'       => $email->get(),
                    'channels' => [
                        'email' => [
                            'status'     => $status,
                            'statusDate' => (new \DateTime('now'))->format("Y-m-d\TH:i:s.000\Z"),
                        ],
                    ],
                ],
            ],
        ];
    }
}
