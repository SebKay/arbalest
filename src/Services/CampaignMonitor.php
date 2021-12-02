<?php

declare(strict_types=1);

namespace Arbalest\Services;

use Arbalest\Values\Configs\CampaignMonitorConfig;
use Arbalest\Values\EmailAddress;

class CampaignMonitor extends Service
{
    protected \CS_REST_Subscribers $sdk;

    /**
     * @param array<string> $config
     */
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
            throw new \Exception(
                'There was an error subscribing that email address.',
                (int) $e->getCode()
            );
        }
    }

    public function unsubscribe(
        EmailAddress $email_address
    ): bool {
        try {
            $result = $this->sdk->unsubscribe($email_address->get());

            return $result->was_successful();
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
            $emails = \array_map(static function (EmailAddress $email) {
                return [
                    'EmailAddress'   => $email->get(),
                    'ConsentToTrack' => 'yes',
                ];
            }, $this->convertArrayOfEmailAddresses($emails));

            $result = $this->sdk->import($emails, true);

            return $result->was_successful();
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
            $success = false;

            foreach ($this->convertArrayOfEmailAddresses($emails) as $email) {
                $result = $this->sdk->unsubscribe($email->get());

                if ($result->was_successful()) {
                    $success = true;
                } else {
                    $success = true;
                }
            }

            return $success;
        } catch (\Exception $e) {
            throw new \Exception(
                'There was an error unsubscribing those email addresses.',
                (int) $e->getCode()
            );
        }
    }
}
