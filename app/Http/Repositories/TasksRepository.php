<?php

namespace App\Http\Repositories;

use App\Models\Tasks;

class TasksRepository
{
    /**
     * model attribute
     *
     * @var Tasks
     */
    protected Tasks $model;

    /**
     * construct method
     *
     * @param Tasks $model
     */
    public function __construct(Tasks $model)
    {
        $this->model = $model;
    }

    /**
     * get all user tasks 
     *
     * @param integer $userId
     * @return Tasks
     */
    public function getUserTasks(int $userId)
    {
        return $this->model->select('*')
            ->where('user_id', $userId)->get();
    }

    /**
     * update task status
     *
     * @param array $params
     * @param integer $id
     * @return Tasks
     */
    public function lastTask(int $userId)
    {
        return $this->model->where('user_id', $userId)
            ->where('done', 0)->limit(1)
            ->orderBy('id', 'DESC')->get();
    }

    /**
     * create task 
     *
     * @param array $taskParams
     * @return Tasks
     */
    public function createTask(array $taskParams)
    {
        return $this->model->create($taskParams);
    }

    /**
     * get task
     *
     * @param integer $id
     * @return Tasks
     */
    public function getTask(int $id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * update task
     *
     * @param array $params
     * @param integer $id
     * @return bool
     */
    public function updateTask(array $params, int $id)
    {
        return $this->model->where('id', $id)->update($params);
    }

    /**
     * update task status
     *
     * @param array $params
     * @param integer $id
     * @return bool
     */
    public function updateStatus(array $params, int $id)
    {
        return $this->model->where('id', $id)->update($params);
    }

    /**
     * delete task
     *
     * @param integer $id
     * @return bool
     */
    public function deleteTask(int $id)
    {
        return $this->model->where('id', $id)->delete();
    }
}
