<?php

declare(strict_types=1);

namespace Lanfisis\WesServerToMqttBridge\WesServer\Parser;

use Lanfisis\WesServerToMqttBridge\HomeAssistant\Entity\Device;
use SimpleXMLElement;

final class ServerInfoParser
{
    public function parse(array $config, SimpleXMLElement $data): Device
    {
        $url = sprintf("http://%s", $config['host']);
        $hwVersion = (string) $data->text[0]->value;
        $swVersion = (string) $data->text[1]->value;
        return new Device($url, [], $hwVersion, ['serial'], 'Cartelectronic', null, 'W.E.S. Serveur V2', null, $swVersion);
    }
}
