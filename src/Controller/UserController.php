<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/comptes', name: 'app_users')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/comptes/{id}/modifier', name: 'app_users_update')]
    public function update(User $user, Request $request, UpdateUserInterface $updateUser): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = (is_string($form->get('plainPassword')->getData()) ? $form->get('plainPassword')->getData() : null);
            $updateUser($user, $plainPassword);

            $this->addFlash('success', 'Compte '.$user->getUsername().' modifié avec succès');

            return $this->redirectToRoute('app_users');
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form,
        ]);
    }
}



