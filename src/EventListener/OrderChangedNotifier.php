<?php

namespace App\EventListener;

use App\Entity\Order;
use App\Message\OrderMessage;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsEntityListener(event: Events::postPersist, method: 'postPersist', entity: Order::class)]
class OrderChangedNotifier
{
    public function __construct(
        private readonly MessageBusInterface $bus,
    ) {
    }

    public function postPersist(Order $order, PostPersistEventArgs $event): void
    {
        $this->bus->dispatch(new OrderMessage('order_create', $order));
    }
}