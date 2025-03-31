<?php

declare(strict_types=1);

namespace Lanfisis\WesServerToMqttBridge\WesServer\Factory;

use Lanfisis\WesServerToMqttBridge\HomeAssistant\Entity\Device;
use Lanfisis\WesServerToMqttBridge\HomeAssistant\Entity\DeviceInterface;
use Lanfisis\WesServerToMqttBridge\HomeAssistant\Entity\Sensor;
use SimpleXMLElement;

final class TeleinfoSensorFactory
{
    public function build(Device $device, string $uid, array $config): Sensor
    {
        return new Sensor(
            sprintf('wes_server_teleinfo_%s_%s', $uid, $config['code']),
            sprintf('WES Server teleinfo %s: %s (%s)', $uid, $config['label'], strtoupper($config['code'])),
            sprintf('wes_server/%s_%s/value', $uid, $config['code']),
            $config['state_class'],
            $config['device_class'],
            $config['unit_of_measurement'],
            $device,
        );
    }
}


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

//SimpleXMLElement Object
//(
//    [ADCO] => 021861820554
//    [OPTARIF] => HC..
//    [ISOUSC] => 45
//    [PTEC] => H. Pleines
//[PAP] => 8400
//    [PAPIJ] => 0
//    [IINST] => 30
//    [IINST1] => 0
//    [IINST2] => 0
//    [IINST3] => 0
//    [TENSION1] => 0
//    [TENSION2] => 0
//    [TENSION3] => 0
//    [IMAX] => 90
//    [IMAX1] => 0
//    [IMAX2] => 0
//    [IMAX3] => 0
//    [PEJP] => 0
//    [DEMAIN] => pas connue !
//[BASE] => 000000000
//    [H_PLEINE] => 048437741
//    [H_CREUSE] => 021610695
//    [EJPHN] => 000000000
//    [EJPHPM] => 000000000
//    [BBRHCJB] => 000000000
//    [BBRHPJB] => 000000000
//    [BBRHCJW] => 000000000
//    [BBRHPJW] => 000000000
//    [BBRHCJR] => 000000000
//    [BBRHPJR] => 000000000
//    [H_WeekEnd] => 000000000
//    [HC_Semaine] => 000000000
//    [HP_Semaine] => 000000000
//    [HC_WeekEnd] => 000000000
//    [HP_WeekEnd] => 000000000
//    [HC_Mercredi] => 000000000
//    [HP_Mercredi] => 000000000
//    [H_SUPER_CREUSE] => 000000000
//    [PRODUCTEUR] => 000000000
//    [INJECTION] => 000000000
//)
