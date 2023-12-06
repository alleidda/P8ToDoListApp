<?php

declare(strict_types=1);

namespace App\UseCase\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

final class UpdateUserRole implements UpdateUserRoleInterface
{
    public function __construct(
        private readonly EntityManagerInterface $manager
    ) {
    }

    public function __invoke(User $user): void
    {
        match ($user->getRoles()) {
            ["ROLE_USER"] => $user->setRoles(["ROLE_ADMIN"]),
            default => $user->setRoles(["ROLE_USER"]),
        };

        $this->manager->persist($user);
        $this->manager->flush();
    }
}
