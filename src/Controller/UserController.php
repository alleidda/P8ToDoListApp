<?php

namespace App\Controller;

use App\DTO\ListTasksDTO;
use App\Entity\User;
use App\Form\UserType;
use App\UseCase\Task\ListTasksInterface;
use App\UseCase\User\CreateUserInterface;
use App\UseCase\User\DeleteUserInterface;
use App\UseCase\User\ListUsersInterface;
use App\UseCase\User\UpdateUserInterface;
use App\UseCase\User\UpdateUserRoleInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends AbstractController
{
    #[Route('/comptes', name: 'app_users')]
    public function index(ListUsersInterface $listUsers, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        /** @var User $user */
        $user = $this->getUser();

        $page = max($request->query->getInt('page', 1), 1);

        return $this->render('user/index.html.twig', [
            'users' => $listUsers($user, $page),
        ]);
    }

   
    #[Route(path: '/comptes/{id}/supprimer', name: 'app_users_delete')]
    public function deleteUser(User $user, DeleteUserInterface $deleteUser, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        /* $deleteUser($user);
        $this->addFlash('success', "L'utilisateur a bien été supprimé"); */

        return $this->redirect((string) $request->headers->get('referer'));
    }



}



