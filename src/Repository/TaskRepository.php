<?php

namespace App\Repository;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Task>
 *
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private readonly int $tasksPerPage
    ) {
        parent::__construct($registry, Task::class);
    }

    /**
     * @return array{
     *     total_items: int,
     *     total_pages: int,
     *     items_per_page: int,
     *     page: int,
     *     embedded: Task[]
     * }
     *
     * @throws NonUniqueResultException
     */
    public function getPaginatedTasks(User $user, int $page, bool $completed): array
    {
        
        $query = $this
            ->createQueryBuilder('task')
            ->orderBy('task.id', 'DESC')
            ->setFirstResult($this->tasksPerPage * ($page - 1))
            ->setMaxResults($this->tasksPerPage)
            ->where('task.completed = :completed')
            ->setParameter('completed', $completed)
            ->andWhere('task.user = :user')
            ->setParameter('user', $user->getId());

        $totalItemsQuery = $this
            ->createQueryBuilder('task')
            ->select('COUNT(task.id)')
            ->where('task.completed = :completed')
            ->setParameter('completed', $completed)
            ->andWhere('task.user = :user')
            ->setParameter('user', $user->getId());

        /** @var Task[] $tasks */
        $tasks = $query->getQuery()->getResult();
        $totalItems = (int) $totalItemsQuery->getQuery()->getSingleScalarResult();

        return [
            'total_items' => $totalItems,
            'total_pages' => (int) ceil($totalItems / $this->tasksPerPage),
            'items_per_page' => $this->tasksPerPage,
            'page' => $page,
            'embedded' => $tasks,
        ];

    
    }

        /**
     * @return array{
     *     total_items: int,
     *     total_pages: int,
     *     items_per_page: int,
     *     page: int,
     *     embedded: Task[]
     * }
     *
     * @throws NonUniqueResultException
     */
    public function getPaginatedTasksAdmin(User $user, int $page, bool $completed): array
    {
        
        $query = $this
            ->createQueryBuilder('task')
            ->orderBy('task.id', 'DESC')
            ->setFirstResult($this->tasksPerPage * ($page - 1))
            ->setMaxResults($this->tasksPerPage)
            ->where('task.completed = :completed')
            ->setParameter('completed', $completed);

        $totalItemsQuery = $this
            ->createQueryBuilder('task')
            ->select('COUNT(task.id)')
            ->where('task.completed = :completed')
            ->setParameter('completed', $completed);

        /** @var Task[] $tasks */
        $tasks = $query->getQuery()->getResult();
        $totalItems = (int) $totalItemsQuery->getQuery()->getSingleScalarResult();

        return [
            'total_items' => $totalItems,
            'total_pages' => (int) ceil($totalItems / $this->tasksPerPage),
            'items_per_page' => $this->tasksPerPage,
            'page' => $page,
            'embedded' => $tasks,
        ];

    
    }

    public function getUserTasks(User $user): array
    {
        return $this
            ->createQueryBuilder('task')
            ->Where('task.user = :user')
            ->setParameter('user', $user->getId())
            ;
    }

    /**
     * @return array{
     *     total_items: int,
     *     total_pages: int,
     *     items_per_page: int,
     *     page: int,
     *     embedded: Task[]
     * }
     *
     * @throws NonUniqueResultException
     */
    public function getAnonPaginatedTasks(int $page): array
    {
        $query = $this
            ->createQueryBuilder('task')
            ->orderBy('task.id', 'DESC')
            ->setFirstResult($this->tasksPerPage * ($page - 1))
            ->setMaxResults($this->tasksPerPage)
            ->where('task.user IS NULL');

        $totalItemsQuery = $this
            ->createQueryBuilder('task')
            ->select('COUNT(task.id)')
            ->where('task.user IS NULL');

        /** @var Task[] $tasks */
        $tasks = $query->getQuery()->getResult();
        $totalItems = (int) $totalItemsQuery->getQuery()->getSingleScalarResult();

        return [
            'total_items' => $totalItems,
            'total_pages' => (int) ceil($totalItems / $this->tasksPerPage),
            'items_per_page' => $this->tasksPerPage,
            'page' => $page,
            'embedded' => $tasks,
        ];
    }
}
