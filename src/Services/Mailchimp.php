<?php

namespace Arbalest\Services;

use Arbalest\Values\Configs\MailchimpConfig;
use Arbalest\Values\EmailAddress;

class Mailchimp extends Service
{
    protected string $listID;

    public function __construct(
        array $config
    ) {
        parent::__construct(new MailchimpConfig($config));

        $this->listID = $this->config->get('list_id');

        $this->http = new \GuzzleHttp\Client([
            'base_uri' => "https://{$this->config->get('server')}.api.mailchimp.com/3.0/",
            'headers'  => [
                'Authorization' => "Bearer {$this->config->get('api_key')}",
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

    /**
     * Check if a contact exists with the provided email address
     */
    protected function contactExists(
        EmailAddress $email_address
    ): bool {
        try {
            $subscriber_hash = self::subscriberHash($email_address->get());

            $request = $this->get("/lists/{$this->listID}/members/{$subscriber_hash}");

            $json_response = \json_decode($request->getBody()->getContents());
            $status        = $json_response->status ?? '';

            if ($status == 'subscribed') {
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
     * @param EmailAddress[] $email_addresses
     */
    protected function createOrUpdateContacts(
        array $email_addresses,
        string $new_status
    ): \Psr\Http\Message\ResponseInterface {
        $members = \array_map(function (EmailAddress $email_address) use ($new_status) {
            return [
                'email_address' => $email_address->get(),
                'status'        => $new_status,
            ];
        }, $email_addresses);

        return $this->post("lists/{$this->listID}", [
            'json' => [
                'members'         => $members,
                'update_existing' => true,
            ],
        ]);
    }

    public function subscribe(
        EmailAddress $email_address
    ): bool {
        try {
            $response = $this->createOrUpdateContact($email_address, 'subscribed');

            if ($response->getStatusCode() == 200) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            throw new \Exception('There was an error subscribing that email address.', (int) $e->getCode());
        }
    }

    public function unsubscribe(
        EmailAddress $email_address
    ): bool {
        try {
            $response = $this->createOrUpdateContact($email_address, 'unsubscribed');

            if ($response->getStatusCode() == 200) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            throw new \Exception('There was an error unsubscribing that email address.', (int) $e->getCode());
        }
    }

    public function subscribeAll(
        array $email_addresses
    ): bool {
        try {
            $response = $this->createOrUpdateContacts($email_addresses, 'subscribed');

            if ($response->getStatusCode() == 200) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            throw new \Exception('There was an error subscribing that email address.', (int) $e->getCode());
        }
    }

    public function unsubscribeAll(
        array $email_addresses
    ): bool {
        try {
            $response = $this->createOrUpdateContacts($email_addresses, 'unsubscribed');

            if ($response->getStatusCode() == 200) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            throw new \Exception('There was an error unsubscribing that email address.', (int) $e->getCode());
        }
    }
}
