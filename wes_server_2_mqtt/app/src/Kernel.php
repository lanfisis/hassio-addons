<?php

declare(strict_types=1);

namespace Lanfisis\WesServerToMqttBridge;

use Lanfisis\WesServerToMqttBridge\Client\MqttClient;
use Lanfisis\WesServerToMqttBridge\Client\MqttClient\Messenger;
use Lanfisis\WesServerToMqttBridge\WesServer\Bridge;
use React\EventLoop\Loop;

/**
 * @see https://fmartinou.github.io/teleinfo2mqtt/#/introduction/
 */
final class Kernel
{
    public function run(): void
    {
        $loop = Loop::get();

        $wesBridge = new Bridge($this->getConfig()['wes']);
        $mqttConfig = $this->getConfig()['mqtt'];
        $client = new MqttClient($loop, $mqttConfig['host'], $mqttConfig['port'], $mqttConfig['options']);
        $client->addToCallToStack(fn (Messenger $messenger) => $wesBridge->declareSensors($messenger));
        $client->addToPeriodicCallToStack(1, fn (Messenger $messenger) => $wesBridge->sendSensorsValues($messenger));
        $client->run();

        $loop->run();
    }

    private function getConfig(): array
    {
        return [
            'mqtt' => [
                'host' => getenv('MQTT_HOST'),
                'port' => (int) getenv('MQTT_PORT'),
                'options' => [
                    'username' => getenv('MQTT_USERNAME'),
                    'password' => getenv('MQTT_PASSWORD'),
                    'clientId' => 'wes_server',
                ]
            ],
            'wes' => [
                'host' => getenv('WES_SERVER_HOST'),
                'username' => getenv('WES_SERVER_USERNAME'),
                'password' => getenv('WES_SERVER_PASSWORD'),
            ]
        ];
    }
}
