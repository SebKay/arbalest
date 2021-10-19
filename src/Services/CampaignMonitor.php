<?php

namespace Arbalest\Services;

use Arbalest\Values\Configs\CampaignMonitorConfig;
use Arbalest\Values\EmailAddress;

class CampaignMonitor extends Service
{
    protected \CS_REST_Subscribers $sdk;

    public function __construct(
        array $config
    ) {
        parent::__construct(new CampaignMonitorConfig($config));

        $this->sdk = new \CS_REST_Subscribers($this->config->get('list_id'), [
            'api_key' => $this->config->get('api_key'),
        ]);
    }

    public function subscribe(
        EmailAddress $email_address
    ): bool {
        try {
            $result = $this->sdk->add([
                'EmailAddress'   => $email_address->get(),
                'ConsentToTrack' => 'yes',
                'Resubscribe'    => true,
            ]);

            return $result->was_successful();
        } catch (\Exception $e) {
            throw new \Exception('There was an error subscribing that email address.', (int) $e->getCode());
        }
    }

    public function unsubscribe(
        EmailAddress $email_address
    ): bool {
        try {
            $result = $this->sdk->unsubscribe($email_address->get());

            return $result->was_successful();
        } catch (\Exception $e) {
            throw new \Exception('There was an error unsubscribing that email address.', (int) $e->getCode());
        }
    }

    public function subscribeAll(
        array $email_addresses
    ): bool {
        try {
            $email_addresses = \array_map(function (EmailAddress $email_address) {
                return [
                    'EmailAddress'   => $email_address->get(),
                    'ConsentToTrack' => 'yes',
                ];
            }, $this->convertArrayOfEmailAddresses($email_addresses));

            $result = $this->sdk->import($email_addresses, true);

            return $result->was_successful();
        } catch (\Exception $e) {
            throw new \Exception('There was an error subscribing those email addresses.', (int) $e->getCode());
        }
    }

    public function unsubscribeAll(
        array $email_addresses
    ): bool {
        try {
            $success = false;

            foreach ($this->convertArrayOfEmailAddresses($email_addresses) as $email_address) {
                $result = $this->sdk->unsubscribe($email_address->get());

                if ($result->was_successful()) {
                    $success = true;
                } else {
                    $success = true;
                }
            }

            return $success;
        } catch (\Exception $e) {
            throw new \Exception('There was an error unsubscribing those email addresses.', (int) $e->getCode());
        }
    }
}
