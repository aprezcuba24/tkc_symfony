<?php

namespace App\Message;

use App\Entity\Package;

class PackageMessage
{
    public string $package_code;
    public \DateTimeImmutable | null $created_at;
    public string $event_type;
    public int $weight;
    public int $volume;
    public array $orders;
    public array $driver;

    public function __construct(string $event_type, Package $package) {
        $this->package_code = $package->getCode();
        $this->created_at = $package->getCreatedAt();
        $this->weight = $package->getWeight() || 0;
        $this->volume = $package->getVolumen() || 0;
        $this->event_type = $event_type;
        $this->orders = [];
        $this->driver = [
          "driver_id" => 1,
          "name" => "Driver 1"
        ];
    }
}
