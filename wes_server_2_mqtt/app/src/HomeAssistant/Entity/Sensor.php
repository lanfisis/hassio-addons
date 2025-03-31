<?php

declare(strict_types=1);

namespace Lanfisis\WesServerToMqttBridge\HomeAssistant\Entity;

final class Sensor implements SensorInterface
{
    public function __construct(
        private string $uniqueId,
        private string $name,
        private string $stateTopic,
        private ?string $stateClass = null,
        private ?string $deviceClass = null,
        private ?string $unitOfMeasurement = null,
        private ?DeviceInterface $device = null,
    ) {
    }

    public function getUniqueId(): string
    {
        return $this->uniqueId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStateTopic(): string
    {
        return $this->stateTopic;
    }

    public function getStateClass(): ?string
    {
        return $this->stateClass;
    }

    public function getDeviceClass(): ?string
    {
        return $this->deviceClass;
    }

    public function getUnitOfMeasurement(): ?string
    {
        return $this->unitOfMeasurement;
    }

    public function getDevice(): ?DeviceInterface
    {
        return $this->device;
    }

    public function jsonSerialize(): iterable
    {
        return [
            'unique_id' => $this->uniqueId,
            'name' => $this->name,
            'state_topic' => $this->stateTopic,
            'state_class' => $this->stateClass,
            'device_class' => $this->deviceClass,
            'unit_of_measurement' => $this->unitOfMeasurement,
            'device' => $this->device,
        ];
    }
}
