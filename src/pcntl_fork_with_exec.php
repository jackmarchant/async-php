<?php

$start = microtime(true);
$path = __DIR__ . '/pcntl_fork_send_email.php';
$emails = implode(',', ['joe@blogs.com', 'jack@test.com']);
$command = 'php ' . $path . ' --emails=%s > /dev/null &';

// Execute the command
echo "running exec\n";
exec(sprintf($command, $emails));
$finish = microtime(true);

$duration = round($finish - $start, 4);
echo "finished web request in $duration\n";