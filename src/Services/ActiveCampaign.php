<?php

declare(strict_types=1);

namespace Arbalest\Services;

use Arbalest\Values\Configs\ActiveCampaignConfig;
use Arbalest\Values\EmailAddress;

class ActiveCampaign extends Service
{
    protected string $listID;
    protected string $accountUrl;
    protected string $apiKey;

    /**
     * @param array<string> $config
     */
    public function __construct(
        array $config
    ) {
        parent::__construct(new ActiveCampaignConfig($config));

        $this->listID     = $this->config->get('list_id');
        $this->accountUrl = $this->config->get('account_url');
        $this->apiKey     = $this->config->get('api_key');

        $this->http = new \GuzzleHttp\Client([
            'base_uri' => "{$this->accountUrl}/api/3/",
            'headers'  => [
                'Api-Token' => $this->apiKey,
            ],
        ]);
    }

    public function subscribe(
        EmailAddress $email
    ): bool {
        try {
            return $this->updateContactSubcriberStatus($email, 1);
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
            return $this->updateContactSubcriberStatus($email, 0);
        } catch (\Exception $e) {
            throw new \Exception(
                'There was an error subscribing that email address.',
                (int) $e->getCode()
            );
        }
    }

    /**
     * Create or update the contact via the API
     */
    protected function createOrUpdateContact(
        EmailAddress $email
    ): int {
        try {
            $response = $this->post('contact/sync', [
                'json' => [
                    'contact' => [
                        'email' => $email->get(),
                    ],
                ],
            ])
                ->getBody()
                ->getContents();

            $response = \GuzzleHttp\Utils::jsonDecode($response);

            return $response->contact->id ?? 0;
        } catch (\Exception $e) {
            throw new \Exception(
                'There was an error creating the contact.',
                (int) $e->getCode()
            );
        }
    }

    /**
     * Change subscribe to "subscribed" or "unsubscribed"
     */
    protected function updateContactSubcriberStatus(
        EmailAddress $email,
        int $new_status
    ): bool {
        try {
            $contact_id = $this->createOrUpdateContact($email);

            $response = $this->post('contactLists', [
                'json' => [
                    'contactList' => [
                        'list'    => $this->listID,
                        'contact' => $contact_id,
                        'status'  => $new_status,
                    ],
                ],
            ]);

            return $response->getStatusCode() === 200;
        } catch (\Exception $e) {
            throw new \Exception(
                'There was an error changing the contact list status.',
                (int) $e->getCode()
            );
        }
    }
}
