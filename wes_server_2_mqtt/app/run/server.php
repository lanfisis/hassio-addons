<?php

use Lanfisis\WesServerToMqttBridge\Kernel;
use Symfony\Component\Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = new Dotenv();
    $dotenv->loadEnv(__DIR__ . '/../.env');
}


$kernel = new Kernel();
$kernel->run();
