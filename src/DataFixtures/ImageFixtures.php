<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ImageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->loadImage($manager);
    }

    public function loadImage(ObjectManager $manager): void
    {
        foreach ($this->getImage() as [$id, $path]) {
            $image = new Image();
            $image->setPath($path);
            $image->setCreatedAt(new() \DateTimeImmutable(false));
            $manager->persist($image);
            $this->addReference('image_' . $id, $image);
        }
        $manager->flush();
    }

    private function getImage(): array
    {
        return [
            [1, 'https://khajackie2206.s3.ap-southeast-1.amazonaws.com/adff179252b819b344d7d2f5ee03c604lamborghini.jpg'],
            [2, 'https://khajackie2206.s3.ap-southeast-1.amazonaws.com/6e47636c53b2a0f639eb9c94a8b9a7f3g63.jpg'],
            [3, 'https://khajackie2206.s3.ap-southeast-1.amazonaws.com/6e47636c53b2a0f639eb9c94a8b9a7f3g63.jpg'],
        ];
    }
}
