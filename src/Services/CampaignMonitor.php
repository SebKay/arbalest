<?php

namespace Arbalest\Services;

use Arbalest\Values\Configs\CampaignMonitorConfig;
use Arbalest\Values\EmailAddress;

class CampaignMonitor extends Service
{
    protected \CS_REST_Subscribers $service;

    public function __construct(
        array $config
    ) {
        parent::__construct(new CampaignMonitorConfig($config));

        $this->service = new \CS_REST_Subscribers($this->config->get('list_id'), [
            'api_key' => $this->config->get('api_key'),
        ]);
    }

    public function subscribe(
        EmailAddress $email_address
    ): bool {
        try {
            $result = $this->service->add([
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
            $result = $this->service->unsubscribe($email_address->get());

            return $result->was_successful();
        } catch (\Exception $e) {
            throw new \Exception('There was an error unsubscribing that email address.', (int) $e->getCode());
        }
    }
}
