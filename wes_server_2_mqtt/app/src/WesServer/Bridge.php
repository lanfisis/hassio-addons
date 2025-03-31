<?php

declare(strict_types=1);

namespace Lanfisis\WesServerToMqttBridge\WesServer;

use Lanfisis\WesServerToMqttBridge\Client\MqttClient\Messenger;
use Lanfisis\WesServerToMqttBridge\WesServer\Factory\DeviceFactory;
use Lanfisis\WesServerToMqttBridge\WesServer\Factory\TeleinfoSensorFactory;
use Lanfisis\WesServerToMqttBridge\WesServer\Factory\TeleinfoSensorsCollectionFactory;
use SimpleXMLElement;
use Symfony\Component\HttpClient\Exception\TimeoutException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class Bridge
{
    private HttpClientInterface $client;

    public function __construct(
        private readonly array $config,
        private readonly DeviceFactory $deviceFactory = new DeviceFactory(),
        private readonly TeleinfoSensorsCollectionFactory $teleinfoSensorsCollectionFactory = new TeleinfoSensorsCollectionFactory(),
    ) {
        $this->client = HttpClient::createForBaseUri("http://{$config['host']}", [
            'auth_basic' => [$config['username'], $config['password']],
        ]);
    }

    public function declareSensors(Messenger $messenger): void
    {
        $sensors = [];
        $serverInfos = $this->getServerInfo();
        if (null === $serverInfos) {
            return;
        }

        $device = $this->deviceFactory->build($this->config, $this->getServerInfo());
        foreach ($this->getXmlData() as $key => $data) {
            if (str_contains($key, 'tic')) {
                $sensors = $sensors + $this->teleinfoSensorsCollectionFactory->build($device, $key, $data);

            }
        }

        foreach ($sensors as $key => $sensor) {
            $messenger->publish(sprintf('homeassistant/sensor/teleinfo/%s/config', $key), json_encode($sensor), true);
        }
    }

    public function sendSensorsValues(Messenger $messenger): void
    {
        $codes = TeleinfoSensorsCollectionFactory::CODES;
        foreach ($this->getXmlData() as $key => $data) {
            if (str_contains($key, 'tic')) {
                foreach ($data as $code => $value) {
                    if (false === in_array($code, array_keys($codes))) {
                        continue;
                    }
                    $messenger->publish(sprintf('wes_server/%s_%s/value', $key, $codes[$code]['code']), (string) $value);
                }
            }
        }
    }

    private function getXmlData(): SimpleXMLElement|array
    {
        try {
            return simplexml_load_string(
                $this->client->request('GET', '/data.cgx')->getContent()
            );
        } catch (TimeoutException) {
            return [];
        }
    }

    private function getServerInfo(): ?SimpleXMLElement
    {
        try {
            return simplexml_load_string(
                $this->client->request('GET', '/WEBPROG/CGX/INFOCFG.CGX')->getContent()
            );
        } catch (TimeoutException) {
            return null;
        }
    }
}
