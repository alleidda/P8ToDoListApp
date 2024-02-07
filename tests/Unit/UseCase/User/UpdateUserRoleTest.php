<?php

// declare(strict_types=1);

// namespace App\Tests\Unit\UseCase\User;

// use App\Entity\User;
// use App\UseCase\User\UpdateUserRole;
// use Doctrine\ORM\EntityManager;
// use PHPUnit\Framework\TestCase;

// final class UpdateUserRoleTest extends TestCase
// {
//     public function testUpdateUserSuccess(): void
//     {
//         $entityManager = self::createMock(EntityManager::class);

//         $user = new User();
//         $user->setRoles("ROLE_USER");

//         $entityManager->expects(self::exactly(2))->method('persist')->with($user);
//         $entityManager->expects(self::exactly(2))->method('flush');

//         $updateUserRole = new UpdateUserRole($entityManager);
//         $updateUserRole($user);

//         self::assertSame('ROLE_ADMIN', $user->getRoles());

//         $user->setRoles('ROLE_ADMIN');
//         $updateUserRole($user);

//         self::assertEquals('ROLE_USER', $user->getRoles());
//     }
// }
