<?php

namespace App\Controller;

use App\DTO\ListTasksDTO;
use App\Entity\Task;
use App\Entity\User;
use App\UseCase\Task\CreateTaskInterface;
use App\UseCase\Task\DeleteTaskInterface;
use App\UseCase\Task\ListTasksInterface;
use App\UseCase\Task\MarkTaskInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class TaskController extends AbstractController
{
    #[Route(path: '/app', name: 'app_home')]
    public function index(ListTasksInterface $listTasks, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        /** @var User $user */
        $user = $this->getUser();

        $listTasksDTO = new ListTasksDTO(
            max($request->query->getInt('page', 1), 1),
            $request->query->getBoolean('completed'),
            $request->query->getBoolean('anon')
        );

        return $this->render('task/index.html.twig', [
            'tasks' => $listTasks($user, $listTasksDTO),
        ]);
    }

    #[Route(path: '/app/taches/{id}/supprimer', name: 'app_task_delete')]
    #[IsGranted(attribute: 'delete', subject: 'task')]
    public function delete(Task $task, DeleteTaskInterface $deleteTask): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $deleteTask($task);

        $this->addFlash('success', 'Tâche supprimée');

        return $this->redirectToRoute('app_home');
    }
}
