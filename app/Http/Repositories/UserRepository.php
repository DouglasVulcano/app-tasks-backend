<?php

namespace App\Http\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * model attribute
     *
     * @var User
     */
    protected User $model;

    /**
     * construct method
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * create new user
     *
     * @param integer $userId
     * @return object
     */
    public function createUser(array $userData): object
    {
        $user = $this->model->create($userData);
        return $user;
    }
}
