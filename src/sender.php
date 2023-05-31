<?php

require 'vendor/autoload.php';

use Aws\Sqs\SqsClient;

// Initialize the SQS client
$client = new SqsClient([
    'region' => 'us-east-1',
    'version' => 'latest',
    'credentials' => [
        'key' => 'YOUR_AWS_ACCESS_KEY',
        'secret' => 'YOUR_AWS_SECRET_ACCESS_KEY',
    ],
]);

// Define the message details
$message = [
    'to' => 'john@example.com',
    'subject' => 'Hello John',
    'message' => 'This is a test email for John.',
];

// Send the message to SQS
$result = $client->sendMessage([
    'QueueUrl' => 'YOUR_SQS_QUEUE_URL',
    'MessageBody' => json_encode($message),
]);

echo "Message sent to SQS with MessageId: " . $result['MessageId'] . "\n";