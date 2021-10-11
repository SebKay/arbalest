<?php

namespace Arbalest\Services;

use Arbalest\Values\EmailAddress;
use Arbalest\Values\MailchimpConfig;

class Mailchimp extends Service
{
    protected string $apiBaseUri;
    protected string $serverCode;
    protected string $listID;
    protected \GuzzleHttp\Client $http;

    public function __construct(array $config)
    {
        parent::__construct(new MailchimpConfig($config));

        $this->apiKey     = $this->config->get('api_key');
        $this->listID     = $this->config->get('list_id');
        $this->serverCode = $this->config->get('server');

        $this->apiBaseUri = "https://{$this->serverCode}.api.mailchimp.com/3.0/";

        $this->http = new \GuzzleHttp\Client([
            'base_uri' => $this->apiBaseUri,
            'headers'  => [
                'Authorization' => "Bearer {$this->apiKey}",
            ],
        ]);
    }

    /**
     * Perform a GET request
     *
     * @param string $url
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function get(string $url, array $params = []): \Psr\Http\Message\ResponseInterface
    {
        return $this->http->get($url, $params);
    }

    /**
     * Perform a POST request
     *
     * @param string $url
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function put(string $url, array $params = []): \Psr\Http\Message\ResponseInterface
    {
        return $this->http->put($url, $params);
    }

    /**
     * Generate a "subscriber hash" from an email address
     *
     * @param string $email_address
     * @return string
     */
    protected function subscriberHash(string $email_address): string
    {
        return \md5(\strtolower($email_address));
    }

    /**
     * Check if a contact exists with the provided email address
     *
     * @param EmailAddress $email_address
     * @return bool
     */
    protected function contactExists(EmailAddress $email_address): bool
    {
        try {
            $request = $this->get("/lists/{$this->listID}/members/{$this->subscriberHash($email_address->get())}");

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
     *
     * @param EmailAddress $email_address
     * @param string $new_status
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function createOrUpdateContact(EmailAddress $email_address, string $new_status): \Psr\Http\Message\ResponseInterface
    {
        return $this->put("lists/{$this->listID}/members/{$this->subscriberHash($email_address->get())}", [
            'json' => [
                'email_address' => $email_address->get(),
                'status'        => $new_status,
            ],
        ]);
    }

    /**
     * Subscribe email address to list
     *
     * @param EmailAddress $email_address
     * @return bool
     */
    public function subscribe(EmailAddress $email_address): bool
    {
        try {
            $response = $this->createOrUpdateContact($email_address, 'subscribed');

            if ($response->getStatusCode() == 200) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            throw new \Exception('There was an error subscribing that email address.', $e->getCode());
        }
    }

    /**
     * Unsubscribe email address from list
     *
     * @param EmailAddress $email_address
     * @return bool
     */
    public function unsubscribe(EmailAddress $email_address): bool
    {
        try {
            $response = $this->createOrUpdateContact($email_address, 'unsubscribed');

            if ($response->getStatusCode() == 200) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            throw new \Exception('There was an error unsubscribing that email address.', $e->getCode());
        }
    }
}
