<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user
            ->setEmail('demo@demo.fr')
            ->setUsername('demo')
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->hasher->hashPassword($user, 'demo'));

        $manager->persist($user);

        $admin = new User();
        $admin
            ->setEmail('admin@demo.fr')
            ->setUsername('admin')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->hasher->hashPassword($admin, 'demo'));

        $manager->persist($admin);

        for ($i = 0; $i < 10; ++$i) {
            $fakeUser = new User();
            $fakeUser
                ->setUsername("user$i")
                ->setEmail("user$i@demo.fr")
                ->setPassword($this->hasher->hashPassword($fakeUser, 'demo'));

            if ($i < 3) {
                $fakeUser->setRoles(['ROLE_ADMIN']);
            } else {
                $fakeUser->setRoles(['ROLE_USER']);   
            }

            $manager->persist($fakeUser);
        }

        $manager->flush();
    }
}
