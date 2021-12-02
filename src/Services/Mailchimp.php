<?php

declare(strict_types=1);

namespace Arbalest\Services;

use Arbalest\Values\Configs\MailchimpConfig;
use Arbalest\Values\EmailAddress;

class Mailchimp extends Service
{
    protected string $listID;
    protected string $server;
    protected string $apiKey;

    /**
     * @param array<string> $config
     */
    public function __construct(
        array $config
    ) {
        parent::__construct(new MailchimpConfig($config));

        $this->listID = $this->config->get('list_id');
        $this->server = $this->config->get('server');
        $this->apiKey = $this->config->get('api_key');

        $this->http = new \GuzzleHttp\Client([
            'base_uri' => "https://{$this->server}.api.mailchimp.com/3.0/",
            'headers'  => [
                'Authorization' => "Bearer {$this->apiKey}",
            ],
        ]);
    }

    /**
     * Generate a "subscriber hash" from an email address
     */
    public static function subscriberHash(
        string $email_address
    ): string {
        return \md5(\strtolower($email_address));
    }

    public function subscribe(
        EmailAddress $email
    ): bool {
        try {
            $response = $this->createOrUpdateContact($email, 'subscribed');

            return $response->getStatusCode() === 200 ? true : false;
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
            $response = $this->createOrUpdateContact($email, 'unsubscribed');

            return $response->getStatusCode() === 200 ? true : false;
        } catch (\Exception $e) {
            throw new \Exception(
                'There was an error unsubscribing that email address.',
                (int) $e->getCode()
            );
        }
    }

    /**
     * @param array<string> $email_addresses
     */
    public function subscribeAll(
        array $email_addresses
    ): bool {
        try {
            $response = $this->createOrUpdateContacts(
                $this->convertArrayOfEmailAddresses($email_addresses),
                'subscribed'
            );

            return $response->getStatusCode() === 200 ? true : false;
        } catch (\Exception $e) {
            throw new \Exception(
                'There was an error subscribing those email addresses.',
                (int) $e->getCode()
            );
        }
    }

    /**
     * @param array<string> $email_addresses
     */
    public function unsubscribeAll(
        array $email_addresses
    ): bool {
        try {
            $response = $this->createOrUpdateContacts(
                $this->convertArrayOfEmailAddresses($email_addresses),
                'unsubscribed'
            );

            return $response->getStatusCode() === 200 ? true : false;
        } catch (\Exception $e) {
            throw new \Exception(
                'There was an error unsubscribing those email addresses.',
                (int) $e->getCode()
            );
        }
    }

    /**
     * Check if a contact exists with the provided email address
     */
    protected function contactExists(
        EmailAddress $email_address
    ): bool {
        try {
            $hash = self::subscriberHash($email_address->get());

            $request  = $this->get("/lists/{$this->listID}/members/{$hash}");
            $response = \json_decode($request->getBody()->getContents());
            $status   = $response->status ?? '';

            if ($status === 'subscribed') {
                return true;
            }

            return false;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return false;
        }
    }

    /**
     * Create or update a contact
     */
    protected function createOrUpdateContact(
        EmailAddress $email_address,
        string $new_status
    ): \Psr\Http\Message\ResponseInterface {
        $subscriber_hash = self::subscriberHash($email_address->get());

        return $this->put("lists/{$this->listID}/members/{$subscriber_hash}", [
            'json' => [
                'email_address' => $email_address->get(),
                'status'        => $new_status,
            ],
        ]);
    }

    /**
     * Create or update a contact
     *
     * @param array<EmailAddress> $email_addresses
     */
    protected function createOrUpdateContacts(
        array $email_addresses,
        string $new_status
    ): \Psr\Http\Message\ResponseInterface {
        $members = \array_map(
            static function (EmailAddress $email) use ($new_status) {
                return [
                    'email_address' => $email->get(),
                    'status'        => $new_status,
                ];
            },
            $email_addresses
        );

        return $this->post("lists/{$this->listID}", [
            'json' => [
                'members'         => $members,
                'update_existing' => true,
            ],
        ]);
    }
}
