<?php

declare(strict_types=1);

namespace Arbalest\Services;

use Arbalest\Values\Configs\CampaignMonitorConfig;
use Arbalest\Values\EmailAddress;

class CampaignMonitor extends Service
{
    protected \CS_REST_Subscribers $sdk;
    protected string $listID;
    protected string $apiKey;

    /**
     * @param array<string> $config
     */
    public function __construct(
        array $config
    ) {
        parent::__construct(new CampaignMonitorConfig($config));

        $this->listID = $this->config->get('list_id');
        $this->apiKey = $this->config->get('api_key');

        $this->sdk = new \CS_REST_Subscribers($this->listID, [
            'api_key' => $this->apiKey,
        ]);
    }

    public function subscribe(
        EmailAddress $email
    ): bool {
        try {
            return $this->sdk
                ->add([
                    'EmailAddress'   => $email->get(),
                    'ConsentToTrack' => 'yes',
                    'Resubscribe'    => true,
                ])
                ->was_successful();
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
            return $this->sdk
                ->unsubscribe($email->get())
                ->was_successful();
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

            return $this->sdk
                ->import($emails, true)
                ->was_successful();
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
            foreach ($this->convertArrayOfEmailAddresses($emails) as $email) {
                $this->sdk->unsubscribe($email->get());
            }

            return true;
        } catch (\Exception $e) {
            throw new \Exception(
                'There was an error unsubscribing those email addresses.',
                (int) $e->getCode()
            );
        }
    }
}
