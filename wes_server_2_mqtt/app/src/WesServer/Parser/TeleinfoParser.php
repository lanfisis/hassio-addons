<?php

declare(strict_types=1);

namespace Lanfisis\WesServerToMqttBridge\WesServer\Parser;

use Lanfisis\WesServerToMqttBridge\HomeAssistant\Entity\Device;
use SimpleXMLElement;

final class TeleinfoParser
{
    public function parse(SimpleXMLElement $data): array
    {
//        $url = sprintf("http://%s", $config['host']);
//        $swVersion = (string) $data->info->firmware;
//        $device = new Device($url, [], '2', ['serial'], 'Cartelectronic', null, 'W.E.S. Serveur V2', null, $swVersion);

        //
//                $id = (string) $model->tic1->ADCO;
//                $label = 'H_PLEINE';
//
//                $data = [
//                    'unique_id' => 'teleinfo_' . $id . '_' . $label,
//                    'name' => 'Teleinfo ' . $id . ' ' . $label,
//                    'state_topic' => 'homeassistant/sensor/teleinfo/' . $id . '_' . $label .'/value',
//                    'state_class' => 'total_increasing',
//                    'device_class' => 'energy',
////                    'value_template' => '{{ value_json.' . $label . '.value }}',
//                    'unit_of_measurement' => 'Wh',
//                    'device' => [
//                        'identifiers' => [$id],
//                        'manufacturer' => 'Enedis',
//                        'model' => 'linky_' . $id,
//                        'name' => 'Linky ' . $id,
//                    ],
//                ];
////                $data = [
////                    'unique_id' => 'teleinfo_test',
////                    'name' => 'Teleinfo',
////                    'state_topic' => 'homeassistant/sensor/teleinfo/value',
////                    'state_class' => 'measurement',
////                    'device_class' => 'apparent_power',
////                    'unit_of_measurement' => 'VA',
////                ];
//
        return [];
    }
}
