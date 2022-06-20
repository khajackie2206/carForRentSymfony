<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);
    }

    public function loadUsers(ObjectManager $manager): void
    {
        foreach ($this->getUserData() as [$id, $email, $roles, $password, $name]) {
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($this->passwordHasher->hashPassword($user, $password));
            $user->setRoles($roles);
            $user->setName($name);
            $user->setCreatedAt(new() \DateTimeImmutable(false));
            $manager->persist($user);
            $this->addReference('user_' . $id, $user);
        }
        $manager->flush();
    }

    private function getUserData(): array
    {
        return [
            [1, 'kha@123', ['ROLE_USER'], '123', 'khajackie1'],
            [2, 'kha@1234', ['ROLE_ADMIN'], '123', 'khajackie2'],
            [3, 'kha@12345', ['ROLE_USER'], '123', 'khajackie3'],
        ];
    }
}
