<?php

use GuzzleHttp\Client;

class MailosaurForwarder
{
    protected $apiKey;
    protected $serverId;
    protected $client;

    public function __construct($apiKey, $serverId)
    {
        $this->apiKey = $apiKey;
        $this->serverId = $serverId;
        $this->client = new Client(['base_uri' => 'https://mailosaur.com/']);
    }

    public function forwardEmails($recipientEmail)
    {
        $response = $this->client->get("api/messages?server={$this->serverId}", [
            'auth' => [$this->apiKey, ''],
        ]);

        $emails = json_decode($response->getBody(), true)['items'];

        foreach ($emails as $email) {
            $this->client->post('api/messages/forward', [
                'auth' => [$this->apiKey, ''],
                'json' => [
                    'messageId' => $email['id'],
                    'to' => [$recipientEmail],
                ],
            ]);
        }
    }
}

// Usage
$apiKey = 'mEWrFqLbDJLpTwY3A3hTw31tGsx10j4J';
$serverId = 'cp4qhxh4';
$recipientEmail = 'ahmadagha345678@gmail.com';

$forwarder = new MailosaurForwarder($apiKey, $serverId);
$forwarder->forwardEmails($recipientEmail);
