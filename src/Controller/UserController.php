<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\UseCase\User\CreateUserInterface;
use App\UseCase\User\DeleteUserInterface;
use App\UseCase\User\ListUsersInterface;
use App\UseCase\User\UpdateUserInterface;
use App\UseCase\User\UpdateUserRoleInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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




}



