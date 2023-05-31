<?php

require __DIR__ . '/../vendor/autoload.php'; // Include the autoload file for the amphp/amp library

use function Amp\delay;

function sendEmail($to, $subject, $message)
{
    delay(3000)->onResolve(function () use ($to) {
        echo "Email sent to: $to\n";
    });
}

$emails = [
    [
        'to' => 'john@example.com',
        'subject' => 'Hello John',
        'message' => 'This is a test email for John.',
    ],
    [
        'to' => 'jane@example.com',
        'subject' => 'Hello Jane',
        'message' => 'This is a test email for Jane.',
    ],
    // Add more email entries as needed
];

foreach ($emails as $email) {
    $future1 = Amp\async(static function () use ($email) {
        $to = $email['to'];
        $subject = $email['subject'];
        $message = $email['message'];
        sendEmail($to, $subject, $message);
    });
}

echo "All emails sent.\n";