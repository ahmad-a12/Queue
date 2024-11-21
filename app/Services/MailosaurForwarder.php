<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

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
        try {
            // Fetch emails from Mailosaur
            $response = $this->client->get("api/messages?server={$this->serverId}", [
                'auth' => [$this->apiKey, ''],
            ]);

            $emails = json_decode($response->getBody(), true)['items'];

            if (empty($emails)) {
                Log::info("No emails found in Mailosaur for server {$this->serverId}");
            }

            foreach ($emails as $email) {
                $this->sendEmail($email, $recipientEmail);
            }
        } catch (\Exception $e) {
            Log::error("Failed to fetch emails from Mailosaur: " . $e->getMessage());
        }
    }

    protected function sendEmail($email, $recipientEmail)
    {
        $subject = $email['subject'] ?? 'No Subject';
        $body = $email['html']['body'] ?? 'No Content';

        try {
            Mail::send([], [], function ($message) use ($recipientEmail, $subject, $body) {
                $message->to($recipientEmail)
                        ->subject($subject)
                        ->html($body, 'text/html');
            });

            Log::info("Email forwarded to {$recipientEmail} with subject {$subject}");
        } catch (\Exception $e) {
            Log::error("Failed to send email to {$recipientEmail}: " . $e->getMessage());
        }
    }
}


$apiKey = 'mEWrFqLbDJLpTwY3A3hTw31tGsx10j4J';
$serverId = 'cp4qhxh4';
$recipientEmail = 'ahmadagha345678@gmail.com';

$forwarder = new MailosaurForwarder($apiKey, $serverId);
$forwarder->forwardEmails($recipientEmail);
