<?php

declare(strict_types=1);

namespace Arbalest\Services;

use Arbalest\Values\Configs\HubSpotConfig;
use Arbalest\Values\EmailAddress;
use Arbalest\Values\HubSpotContact;
use GuzzleHttp\Exception\GuzzleException;

class HubSpot extends Service
{
    protected string $apiKey;

    /**
     * @param array<string> $config
     */
    public function __construct(
        array $config
    ) {
        parent::__construct(new HubSpotConfig($config));

        $this->apiKey = $this->config->get('api_key');

        $this->http = new \GuzzleHttp\Client([
            'base_uri' => "https://api.hubapi.com/",
            'headers'  => [
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * @param array<string> $params
     *
     * @return array<string>
     */
    protected function formatParamsForRequest(
        array $params
    ): array {
        return [
            'json' => $params,
        ];
    }

    protected function getExistingContact(
        int $contactID
    ): HubSpotContact {
        $response = $this->get("crm/v3/objects/contacts/{$contactID}?hapikey={$this->apiKey}");

        return new HubSpotContact(
            \json_decode($response->getBody()->getContents())
        );
    }

    protected function createOrGetExistingContact(
        EmailAddress $email
    ): HubSpotContact {
        try {
            $create_contact_response = $this->post("crm/v3/objects/contacts?hapikey={$this->apiKey}", [
                'properties' => [
                    'email' => $email->get(),
                ],
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $error_response = $e->getResponse();

            if ($error_response->getStatusCode() != 409) {
                throw new \Exception(
                    $error_response->getReasonPhrase(),
                    $error_response->getStatusCode()
                );
            }

            $error_response_decoded = \json_decode($error_response->getBody()->getContents());
            $existing_contact_id    = (int) explode('Existing ID: ', $error_response_decoded->message)[1] ?? '';

            return $this->getExistingContact($existing_contact_id);
        }

        if ($create_contact_response->getStatusCode() !== 201) {
            throw new \Exception(
                $create_contact_response->getReasonPhrase(),
                $create_contact_response->getStatusCode()
            );
        }

        return new HubSpotContact(
            \json_decode($create_contact_response->getBody()->getContents())
        );
    }

    public function subscribe(
        EmailAddress $email
    ): bool {
        try {
            $contact = $this->createOrGetExistingContact($email);

            \ray('Contact details', $contact);

            // $response = $this->post("communication-preferences/v3/subscribe?hapikey={$this->apiKey}", [
            //     'emailAddress'   => $contact_details['email'] ?? '',
            //     'subscriptionId' => '128647135',
            // ]);

            // $response_decoded = \json_decode($response->getBody()->getContents());

            // \ray('Subscribed response', $response_decoded);

            return true;
        } catch (\Exception $e) {
            \ray('Error', $e)->red();

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
            return true;
        } catch (\Exception $e) {
            throw new \Exception(
                'There was an error unsubscribing that email address.',
                (int) $e->getCode()
            );
        }
    }

    /**
     * @param array<string> $emails
     */
    public function subscribeAll(
        array $emails
    ): bool {
        try {
            return true;
        } catch (\Exception $e) {
            throw new \Exception(
                'There was an error subscribing those email addresses.',
                (int) $e->getCode()
            );
        }
    }

    /**
     * @param array<string> $emails
     */
    public function unsubscribeAll(
        array $emails
    ): bool {
        try {
            return true;
        } catch (\Exception $e) {
            throw new \Exception(
                'There was an error unsubscribing those email addresses.',
                (int) $e->getCode()
            );
        }
    }
}
