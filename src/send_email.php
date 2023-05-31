<?php

$email = explode('--email=', $argv[1])[1];
sleep(5);
echo "sending email to $email\n";