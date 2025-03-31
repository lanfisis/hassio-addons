<?php

declare(strict_types=1);

namespace Lanfisis\WesServerToMqttBridge\WesServer\Factory;

use Lanfisis\WesServerToMqttBridge\HomeAssistant\Entity\Device;
use Lanfisis\WesServerToMqttBridge\HomeAssistant\Entity\Sensor;
use SimpleXMLElement;

final class TeleinfoSensorsCollectionFactory
{
    public const CODES = [
        'PAP' => [
            'code' => 'papp',
            'label' => 'Apparent power',
            'state_class' => 'measurement',
            'device_class' => 'apparent_power',
            'unit_of_measurement' => 'VA',
        ],
        'ISOUSC' => [
            'code' => 'isousc',
            'label' => 'Subscribed intensity',
            'state_class' => 'measurement',
            'device_class' => 'current',
            'unit_of_measurement' => 'A',
        ],
        'IINST' => [
            'code' => 'iinst',
            'label' => 'Instant Intensity',
            'state_class' => 'measurement',
            'device_class' => 'current',
            'unit_of_measurement' => 'A',
        ],
        'IMAX' => [
            'code' => 'imax',
            'label' => 'Maximum intensity called',
            'state_class' => 'measurement',
            'device_class' => 'current',
            'unit_of_measurement' => 'A',
        ],
        'H_CREUSE' => [
            'code' => 'hchc',
            'label' => 'Off-peak hours option index',
            'state_class' => 'total',
            'device_class' => 'energy',
            'unit_of_measurement' => 'Wh',
        ],
        'H_PLEINE' => [
            'code' => 'hchp',
            'label' => 'Peak hours option index',
            'state_class' => 'total',
            'device_class' => 'energy',
            'unit_of_measurement' => 'Wh',
        ],
    ];

    public function __construct(private TeleinfoSensorFactory $teleinfoSensorFactory = new TeleinfoSensorFactory())
    {
    }

    public function build(Device $device, string $uid, SimpleXMLElement $data): array
    {
        $sensors = [];
        foreach ($this->prepareCodes($data) as $code) {
            $sensors[sprintf("%s_%s", $uid, self::CODES[$code]['code'])] = $this->teleinfoSensorFactory->build($device, $uid, self::CODES[$code]);
        }

        return $sensors;
    }

    private function prepareCodes(SimpleXMLElement $data): array
    {
        $codes = [];
        foreach ($data as $key => $value) {
            if (false === in_array($key, array_keys(self::CODES))) {
                continue;
            }
            $codes[] = $key;
        }

        return $codes;
    }
}
