<?php

namespace App\Http\Services;

use App\Http\Repositories\TasksRepository;

class TasksService
{
    /**
     * repository attribute
     *
     * @var TasksRepository
     */
    protected TasksRepository $repository;

    /**
     * construct method
     *
     * @param TasksRepository $repository
     */
    public function __construct(TasksRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * get all user tasks
     *
     * @param integer $userId
     * @return array
     */
    public function getUserTasks(int $userId)
    {
        return $this->repository->getUserTasks($userId);
    }

    /**
     * show user task 
     *
     * @param integer $taskId
     * @return object
     */
    public function showUserTask(int $taskId): object
    {
        return $this->repository->getTask($taskId);
    }

    /**
     *  show user last task
     *
     * @param integer $userId
     * @return object
     */
    public function getUserLastTask(int $userId): object
    {
        return $this->repository->lastTask($userId);
    }

    /**
     * create task 
     *
     * @param array $params
     * @return object
     */
    public function createTask(array $params, int $userId): object
    {
        $user = array('user_id' => $userId);
        $data = array_merge($params, $user);
        $task = $this->repository->createTask($data);
        return $task;
    }

    /**
     * update task
     *
     * @param array $params
     * @param integer $userId
     * @param integer $taskId
     * @return boolean
     */
    public function updateTask(array $params, int $userId, int $taskId): bool
    {
        $user = array('user_id' => $userId);
        $data = array_merge($params, $user);
        return $this->repository->updateTask($data, $taskId);
    }

    /**
     * update status
     *
     * @param array $params
     * @param integer $id
     * @return bool
     */
    public function updateStatus(array $params, int $id): bool
    {
        $updatedStatus = $this->repository->updateStatus($params, $id);
        return $updatedStatus;
    }

    /**
     * delete task
     *
     * @param integer $id
     * @return bool
     */
    public function deleteTask(int $id): bool
    {
        $deletedTask = $this->repository->deleteTask($id);
        return $deletedTask;
    }
}
