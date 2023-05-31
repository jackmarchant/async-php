<?php

$start = microtime(true);
$path = __DIR__ . '/send_email.php';
$command = 'php ' . $path . ' --email=%s > /dev/null &';
$emails = ['joe@blogs.com', 'jack@test.com'];

foreach ($emails as $email) {
    // Execute the command
    exec(sprintf($command, $email));
}
$finish = microtime(true);
$duration = round($finish - $start, 4);
echo "finished web request in $duration\n";