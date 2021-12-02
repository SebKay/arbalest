<?php

declare(strict_types=1);

namespace Arbalest\Services;

use Arbalest\Values\Configs\OmnisendConfig;
use Arbalest\Values\EmailAddress;
use DateTime;

class Omnisend extends Service
{
    /**
     * @param array<string> $config
     */
    public function __construct(
        array $config
    ) {
        parent::__construct(new OmnisendConfig($config));

        $this->http = new \GuzzleHttp\Client([
            'base_uri' => 'https://api.omnisend.com/v3/',
            'headers'  => [
                'X-API-KEY' => $this->config->get('api_key'),
            ],
        ]);
    }

    public function subscribe(
        EmailAddress $email_address
    ): bool {
        try {
            $response = $this->post('contacts', [
                'json' => $this->arrayForEmailContact($email_address, true),
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
            $response = $this->post('contacts', [
                'json' => $this->arrayForEmailContact($email_address, false),
            ]);

            return $response->getStatusCode() === 200 ? true : false;
        } catch (\Exception $e) {
            throw new \Exception('There was an error unsubscribing that email address.', (int) $e->getCode());
        }
    }

    /**
     * Create an array for adding/updating an email contact
     *
     * @return array
     */
    protected function arrayForEmailContact(
        EmailAddress $email_address,
        bool $subscribed = true
    ): array {
        $status = $subscribed === true ? 'subscribed' : 'unsubscribed';

        return [
            'identifiers' => [
                [
                    'type'     => 'email',
                    'id'       => $email_address->get(),
                    'channels' => [
                        'email' => [
                            'status'     => $status,
                            'statusDate' => (new DateTime('now'))->format("Y-m-d\TH:i:s.000\Z"),
                        ],
                    ],
                ],
            ],
        ];
    }
}
