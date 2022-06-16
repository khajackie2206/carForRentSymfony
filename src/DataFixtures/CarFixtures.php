<?php

namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Car;
use App\Entity\Image;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CarFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        foreach ($this->getCar() as [$id, $name, $description, $color, $brand, $price, $seats, $year]){
            $car = new Car();
            /**
             * @var User $createdUser
             */
            $createdUser = $this->getReference('user_'.$id);
            /**
             * @var Image $imagePath
             */
            $imagePath = $this->getReference('image_'.$id);

            $car->setName($name)
                ->setDescription($description)
                ->setColor($color)
                ->setBrand($brand)
                ->setPrice($price)
                ->setSeats($seats)
                ->setYear($year)
                ->setThumbnail($imagePath)
                ->setCreatedUser($createdUser)
                ->setCreatedAt(new \DateTimeImmutable(false));

            $manager->persist($car);
        }
        $manager->flush();
    }

    private function getCar(): array
    {
        return [
            [1, 'Lamboghini', 'Lamboghini', 'Grey', 'Lamboghini',3220, 4, 2022],
            [2, 'G63 sontung-mtp', 'G63 sontung-mtp', 'Black', 'G63', 1800, 7, 2021],
        ];
    }
    public function getDependencies()
    {
        return [
            UserFixtures::class,
            ImageFixtures::class,
        ];
    }
}
