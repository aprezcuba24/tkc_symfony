<?php

namespace App\Message;

use App\Entity\Order;

class OrderMessage
{
    public int $order_id;
    public string $order_code;
    public string $order_status;
    public string $event_type;
    public function __construct(string $event_type, Order $order) {
        $this->order_id = $order->getId();
        $this->order_code = $order->getCode();
        $this->order_status = $order->getStatus()->name;
        $this->event_type = $event_type;
    }
}
