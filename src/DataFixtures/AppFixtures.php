<?php

namespace App\DataFixtures;

use App\Entity\Driver;
use App\Entity\Enums\PackageType;
use App\Entity\Package;
use App\Entity\Product;
use App\Entity\User;
use App\Entity\Place;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Enums\LogisticProviderType;
use App\Entity\LogisticProvider;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);
        $this->loadProducts($manager);
        $this->loadPlaces($manager);
        $this->loadLogisticProviders($manager);
        $this->loadDrivers($manager);
        $this->loadPackages($manager);
    }

    private function loadUsers(ObjectManager $manager): void
    {
        foreach ($this->getUserData() as [$password, $email, $roles]) {
            $user = new User();
            $user->setPassword($this->passwordHasher->hashPassword($user, $password));
            $user->setEmail($email);
            $user->setRoles($roles);

            $manager->persist($user);

            $this->addReference($email, $user);
        }

        $manager->flush();
    }

    private function getUserData(): array
    {
        return [
            // $userData = [$email, $roles];
            ['123', 'admin@tkc.com', [User::ROLE_ADMIN]],
            ['123', 'tom_admin@tkc.com', [User::ROLE_ADMIN]],
            ['123', 'john_user@tkc.com', [User::ROLE_USER]],
        ];
    }

    //Create a function to return some products
    private function getProductData(): array
    {
        return [
            // $productData = [$name, $description];
            ['iPhone 15 Pro', '6.1-inch Super Retina XDR display, A17 Pro chip, and advanced camera system'],
            ['Samsung Galaxy S23 Ultra', '6.8-inch Dynamic AMOLED display, Snapdragon 8 Gen 2, 200MP camera'],
            ['Sony WH-1000XM5', 'Premium wireless noise-canceling headphones with 30-hour battery life'],
            ['Dell XPS 15', '15.6-inch 4K UHD+ touch display, Intel Core i9, 32GB RAM, 1TB SSD'],
            ['Apple Watch Series 9', 'Advanced health monitoring, GPS, and always-on Retina display'],
        ];
    }

    private function loadProducts(ObjectManager $manager): void
    {
        foreach ($this->getProductData() as [$name, $description]) {
            $product = new Product();
            $product->setName($name);
            $product->setDescription($description);

            $manager->persist($product);

            $this->addReference($name, $product);
        }

        $manager->flush();
    }

    private function getPlaceData(): array
    {
        return [
            // $placeData = [$name, $description];
            ['Habana', 'Habana'],
            ['Bayamo', 'Granma'],
            ['Matanzas', 'Matanzas'],
            ['Camaguey', 'Camaguey'],
            ['Cienfuegos', 'Cienfuegos'],
        ];
    }

    private function loadPlaces(ObjectManager $manager): void
    {
        foreach ($this->getPlaceData() as [$name, $description]) {
            $place = new Place();
            $place->setName($name);
            $place->setDescription($description);

            $manager->persist($place);

            $this->addReference($name, $place);
        }

        $manager->flush();
    }

    private function getLogisticProviderData(): array
    {
        return [
            // $logisticProviderData = [$name, $type];
            ['Centro logistico 1', LogisticProviderType::CD],
            ['Centro logistico 2', LogisticProviderType::CAP],
            ['PYME 1', LogisticProviderType::PYME],
        ];
    }

    private function loadLogisticProviders(ObjectManager $manager): void
    {
        foreach ($this->getLogisticProviderData() as [$name, $type]) {
            $logisticProvider = new LogisticProvider();
            $logisticProvider->setName($name);
            $logisticProvider->setDescription("Description for $name");
            $logisticProvider->setType($type);

            $manager->persist($logisticProvider);

            $this->addReference($name, $logisticProvider);
        }

        $manager->flush();
    }

    private function getDriverData(): array
    {
        return [
            // $driverData = [$name, $description];
            ['John Smith', 'Experienced driver with 10+ years of service, specializes in long-haul routes'],
            ['Maria Garcia', 'Certified safety driver with excellent customer service ratings'],
            ['David Kim', 'New team member with background in logistics and navigation']
        ];
    }

    private function loadDrivers(ObjectManager $manager): void
    {
        foreach ($this->getDriverData() as [$name, $description]) {
            $driver = new Driver();
            $driver->setName($name);
            $driver->setDescription($description);

            $manager->persist($driver);

            $this->addReference($name, $driver);
        }

        $manager->flush();
    }

    private function loadPackages(ObjectManager $manager): void
    {
        foreach ($this->getPackageData() as [$name, $description, $createdAt, $type]) {
            $package = new Package();
            $package->setCode($name);
            $package->setDescription($description);
            $package->setCreatedAt($createdAt);
            $package->setType($type);

            $manager->persist($package);

            $this->addReference($name, $package);
        }

        $manager->flush();
    }

    private function getPackageData(): array
    {
        return [
            // $packageData = [$name, $description];
            ['package_1', 'Description for Package 1', new \DateTimeImmutable(), PackageType::DISTRIBUTION],
            ['package_2', 'Description for Package 2', new \DateTimeImmutable(), PackageType::SHIPPING],
            ['package_3', 'Description for Package 3', new \DateTimeImmutable(), PackageType::DISTRIBUTION],
        ];
    }
}
