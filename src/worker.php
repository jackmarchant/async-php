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

// Receive and process messages from SQS
while (true) {
    $result = $client->receiveMessage([
        'QueueUrl' => 'YOUR_SQS_QUEUE_URL',
        'MaxNumberOfMessages' => 1,
        'WaitTimeSeconds' => 20,
    ]);

    if (!empty($result['Messages'])) {
        foreach ($result['Messages'] as $message) {
            $body = json_decode($message['Body'], true);

            // Process the message (send email in this case)
            sendEmail($body['to'], $body['subject'], $body['message']);

            // Delete the message from SQS
            $client->deleteMessage([
                'QueueUrl' => 'YOUR_SQS_QUEUE_URL',
                'ReceiptHandle' => $message['ReceiptHandle'],
            ]);
        }
    }
}

function sendEmail($to, $subject, $message)
{
    sleep(3); // Simulating sending email by sleeping for 3 seconds
    echo "Email sent to: $to\n";
}