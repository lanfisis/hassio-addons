<?php

declare(strict_types=1);

namespace Lanfisis\WesServerToMqttBridge\Logger;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

final class ConsoleLogger implements LoggerInterface
{
    use LoggerTrait;

    public function log($level, string|\Stringable $message, array $context = []): void
    {
        echo $message . "\n";
    }
}
