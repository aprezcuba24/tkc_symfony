<?php

namespace App\Services;

use App\Entity\Package;
use App\Message\PackageMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class PackageService
{
    public function __construct(
        private MessageBusInterface $messageBus,
        private EntityManagerInterface $entityManager
    ) {}

    public function sendPackageToTransport(Package $package): void
    {
        if ($package->isWasSent()) {
            return;
        }
        $this->messageBus->dispatch(new PackageMessage(
            'PACKAGE_DISTRIBUTION',
            $package
        ));
        $package->setWasSent(true);
        $this->entityManager->flush();
    }
}