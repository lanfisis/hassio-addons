<?php

declare(strict_types=1);

namespace Lanfisis\WesServerToMqttBridge\WesServer\Factory;

use Lanfisis\WesServerToMqttBridge\HomeAssistant\Entity\Device;
use SimpleXMLElement;

final class DeviceFactory
{
    public function build(array $config, SimpleXMLElement $data): Device
    {
        $url = sprintf("http://%s:%s@%s", $config['username'], $config['password'], $config['host']);
        $hwVersion = (string) $data->text[0]->value;
        $swVersion = (string) $data->text[1]->value;
        return new Device($url, [], $hwVersion, [md5($config['host'])], 'Cartelectronic', null, 'W.E.S. Serveur V2', null, $swVersion);
    }
}
