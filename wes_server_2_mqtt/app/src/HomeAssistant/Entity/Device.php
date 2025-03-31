<?php

declare(strict_types=1);

namespace Lanfisis\WesServerToMqttBridge\HomeAssistant\Entity;

final class Device implements DeviceInterface
{
    public function __construct(
        private ?string $configurationUrl = null,
        private array $connections = [],
        private ?string $hwVersion = null,
        private array $identifiers = [],
        private ?string $manufacturer = null,
        private ?string $model = null,
        private ?string $name = null,
        private ?string $suggestedArea = null,
        private ?string $swVersion = null,
        private ?string $viaDevice = null,
    ) {
    }

    public function getConfigurationUrl(): ?string
    {
        return $this->configurationUrl;
    }

    public function getConnections(): array
    {
        return $this->connections;
    }

    public function getHwVersion(): ?string
    {
        return $this->hwVersion;
    }

    public function getIdentifiers(): array
    {
        return $this->identifiers;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getSuggestedArea(): ?string
    {
        return $this->suggestedArea;
    }

    public function getSwVersion(): ?string
    {
        return $this->swVersion;
    }

    public function getViaDevice(): ?string
    {
        return $this->viaDevice;
    }

    public function jsonSerialize(): iterable
    {
        return [
            'configuration_url' => $this->configurationUrl ?? '',
            'connections' => $this->connections,
            'hw_version' => $this->hwVersion ?? '',
            'identifiers' => $this->identifiers,
            'manufacturer' => $this->manufacturer ?? '',
            'model' => $this->model ?? '',
            'name' => $this->name ?? '',
            'suggested_area' => $this->suggestedArea ?? '',
            'sw_version' => $this->swVersion ?? '',
            'via_device' => $this->viaDevice ?? '',
        ];
    }
}
