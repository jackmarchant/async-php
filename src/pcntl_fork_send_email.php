<?php

$param = explode('--emails=', $argv[1])[1];
$emails = explode(',', $param);

function sendEmail($to)
{
    // Code to send email (replace with your email sending logic)
    // This is just a mock implementation for demonstration purposes
    sleep(3); // Simulating sending email by sleeping for 3 seconds
    echo "Email sent to: $to\n";
}

$children = [];

foreach ($emails as $email) {
    $pid = pcntl_fork();

    if ($pid == -1) {
        // Fork failed
        die('Error: Unable to fork process.');
    } elseif ($pid == 0) {
        // Child process
        sendEmail($email);
        exit(); // Exit the child process
    } else {
        // Parent process
        $children[] = $pid;
    }
}

echo "running some other things in parent process\n";
// sleep(3);

// Parent process waits for each child process to finish
foreach ($children as $pid) {
    pcntl_waitpid($pid, $status);
    $status = pcntl_wexitstatus($status);
    echo "Child process $pid exited with status: $status\n";
}

echo "All emails sent.\n";