<?php

namespace Arbalest\Services;

use Arbalest\Values\CampaignMonitorConfig;
use Arbalest\Values\EmailAddress;

class CampaignMonitor extends Service
{
    protected \CS_REST_Subscribers $subscribers;

    public function __construct(
        array $config
    ) {
        parent::__construct(new CampaignMonitorConfig($config));

        $this->subscribers = new \CS_REST_Subscribers($this->config->get('list_id'), [
            'api_key' => $this->config->get('api_key'),
        ]);
    }

    /**
     * Subscribe email address to list
     */
    public function subscribe(
        EmailAddress $email_address
    ): bool {
        try {
            $result = $this->subscribers->add([
                'EmailAddress'   => $email_address->get(),
                'ConsentToTrack' => 'yes',
                'Resubscribe'    => true,
            ]);

            return $result->was_successful();
        } catch (\Exception $e) {
            throw new \Exception('There was an error subscribing that email address.', (int) $e->getCode());
        }
    }

    /**
     * Unsubscribe email address from list
     */
    public function unsubscribe(
        EmailAddress $email_address
    ): bool {
        try {
            $result = $this->subscribers->unsubscribe($email_address->get());

            return $result->was_successful();
        } catch (\Exception $e) {
            throw new \Exception('There was an error unsubscribing that email address.', (int) $e->getCode());
        }
    }
}
