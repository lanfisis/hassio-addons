<?php

declare(strict_types=1);

namespace Lanfisis\WesServerToMqttBridge\HomeAssistant\Entity;

use JsonSerializable;

interface DeviceInterface extends JsonSerializable
{
    public function getConfigurationUrl(): ?string;

    public function getConnections(): array;

    public function getHwVersion(): ?string;

    public function getIdentifiers(): array;

    public function getManufacturer(): ?string;

    public function getModel(): ?string;

    public function getName(): ?string;

    public function getSuggestedArea(): ?string;

    public function getSwVersion(): ?string;

    public function getViaDevice(): ?string;
}
