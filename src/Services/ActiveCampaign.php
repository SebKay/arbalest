<?php

namespace Arbalest\Services;

use Arbalest\Values\Configs\ActiveCampaignConfig;
use Arbalest\Values\EmailAddress;

class ActiveCampaign extends Service
{
    protected string $listID;

    public function __construct(
        array $config
    ) {
        parent::__construct(new ActiveCampaignConfig($config));

        $this->listID = $this->config->get('list_id');

        $this->http = new \GuzzleHttp\Client([
            'base_uri' => "{$this->config->get('account_url')}/api/3/",
            'headers'  => [
                'Api-Token' => $this->config->get('api_key'),
            ],
        ]);
    }

    /**
     * Create or update the contact via the API
     *
     * @param EmailAddress $email_address
     * @return int
     */
    protected function createOrUpdateContact(
        EmailAddress $email_address
    ): int {
        try {
            $response = $this->post('contact/sync', [
                'json' => [
                    'contact' => [
                        'email' => $email_address->get(),
                    ],
                ],
            ]);

            $obj = \json_decode($response->getBody()->getContents());

            return $obj->contact->id ?? 0;
        } catch (\Exception $e) {
            throw new \Exception('There was an error creating the contact.', (int) $e->getCode());
        }
    }

    /**
     * Change subscribe to "subscribed" or "unsubscribed"
     *
     * @param EmailAddress $email_address
     * @param int $new_status
     * @return bool
     */
    protected function updateContactSubcriberStatus(
        EmailAddress $email_address,
        int $new_status = 1
    ): bool {
        try {
            $contact_id = $this->createOrUpdateContact($email_address);

            $response = $this->post('contactLists', [
                'json' => [
                    'contactList' => [
                        'list'    => $this->listID,
                        'contact' => $contact_id,
                        'status'  => $new_status,
                    ],
                ],
            ]);

            return $response->getStatusCode() == 200 ? true : false;
        } catch (\Exception $e) {
            throw new \Exception('There was an error changing the contact list status.', (int) $e->getCode());
        }
    }

    public function subscribe(
        EmailAddress $email_address
    ): bool {
        try {
            return $this->updateContactSubcriberStatus($email_address, 1);
        } catch (\Exception $e) {
            throw new \Exception('There was an error subscribing that email address.', (int) $e->getCode());
        }
    }

    public function unsubscribe(
        EmailAddress $email_address
    ): bool {
        try {
            return $this->updateContactSubcriberStatus($email_address, 0);
        } catch (\Exception $e) {
            throw new \Exception('There was an error subscribing that email address.', (int) $e->getCode());
        }
    }

    public function subscribeAll(
        array $email_addresses
    ): bool {
        try {
            return $this->basicBulkSubscribe($email_addresses);
        } catch (\Exception $e) {
            throw new \Exception('There was an error subscribing those email addresses.', (int) $e->getCode());
        }
    }

    public function unsubscribeAll(
        array $email_addresses
    ): bool {
        try {
            return $this->basicBulkUnsubscribe($email_addresses);
        } catch (\Exception $e) {
            throw new \Exception('There was an error unsubscribing those email addresses.', (int) $e->getCode());
        }
    }
}
