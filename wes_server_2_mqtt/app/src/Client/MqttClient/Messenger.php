<?php

declare(strict_types=1);

namespace Lanfisis\WesServerToMqttBridge\Client\MqttClient;


use Morbo\React\Mqtt\Client;
use Morbo\React\Mqtt\Packets\QoS\Levels;
use React\Promise\PromiseInterface;
use React\Socket\ConnectionInterface;

final class Messenger
{
    public function __construct(private Client $client, private ConnectionInterface $stream)
    {
    }

    public function publish(string $topic, string $message, bool $retain = false, int $qos = Levels::AT_MOST_ONCE_DELIVERY, bool $dup = false): PromiseInterface
    {
        return $this->client->publish($this->stream, $topic, $message, $qos, $dup, $retain);
    }
}
