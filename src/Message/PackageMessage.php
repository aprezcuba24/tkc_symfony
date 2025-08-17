<?php

namespace App\Message;

use App\Entity\Order;
use App\Entity\Package;
use App\Entity\Product;

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
        $this->orders = array_map(function (Order $order) {
            return [
                "order_id" => $order->getId(),
                "order_code" => $order->getCode(),
                "created_at" => $order->getCreatedAt()->format('Y-m-d H:i:s'),
                "weight" => $order->getWeight() || 0,
                "volume" => $order->getVolumen() || 0,
                "status" => $order->getStatus()->value,
                "products" => [],
                // "products" => array_map(function (Product $product) {
                //     return [
                //         "product_id" => $product->getId(),
                //         "product_name" => $product->getName(),
                //         "product_description" => $product->getDescription(),
                //     ];
                // }, $order->getProducts()->toArray()),
            ];
        }, $package->getOrders()->toArray());
        $this->driver = [
          "driver_id" => 1,
          "name" => "Driver 1"
        ];
    }
}
