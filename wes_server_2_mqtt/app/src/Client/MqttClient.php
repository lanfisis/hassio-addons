<?php

declare(strict_types=1);

namespace Lanfisis\WesServerToMqttBridge\Client;

use Lanfisis\WesServerToMqttBridge\Logger\ConsoleLogger;
use Morbo\React\Mqtt\Client;
use Morbo\React\Mqtt\ConnectionOptions;
use Morbo\React\Mqtt\Protocols\Version4;
use React\EventLoop\LoopInterface;
use React\Socket\ConnectionInterface;
use RuntimeException;
use Lanfisis\WesServerToMqttBridge\Client\MqttClient\Messenger;

final class MqttClient
{
    private Client $client;

    private array $periodicCallStack = [];

    private array $callStack = [];

    private bool $isRunning = false;

    public function __construct(private LoopInterface $loop, private string $host,  private int $port,  private array $option = [])
    {
        $this->client = new Client($loop, new Version4(), new ConsoleLogger);
    }

    public function addToCallToStack(callable $callback): void
    {
        if (true === $this->isRunning) {
            throw new RuntimeException('There is no way to add call to the stack if server is running.');
        }

        $this->callStack[] = $callback;
    }

    public function addToPeriodicCallToStack(int $interval, callable $callback): void
    {
        if (true === $this->isRunning) {
            throw new RuntimeException('There is no way to add call to the stack if server is running.');
        }

        $this->periodicCallStack[] = [$interval, $callback];
    }

    public function run(): void
    {
        if (true === $this->isRunning) {
            throw new RuntimeException('You can not run server more than once at a time.');
        }
        $this->isRunning = true;

        $connection = $this->client->connect($this->host, $this->port, new ConnectionOptions($this->option));
        $connection->then(function (ConnectionInterface $stream) {
            $messenger = new Messenger($this->client, $stream);
            foreach ($this->callStack as $callback) {
                $callback($messenger);
            }
            foreach ($this->periodicCallStack as list($interval, $callback)) {
                $this->loop->addPeriodicTimer($interval, function () use ($callback, $messenger) {
                    $callback($messenger);
                });
            }
        });
    }
}
