<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\User;
use App\Entity\Place;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

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
}
