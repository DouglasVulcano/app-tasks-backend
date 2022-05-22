<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    /**
     * repository attribute
     *
     * @var UserRepository
     */
    protected UserRepository $repository;

    /**
     * construct method
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * this method will config user data before create a new user
     *
     * @param array $data
     * @return object
     */
    public function registerUser(array $data): object
    {
        $userData = array(
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password'])
        );
        return $this->repository->createUser($userData);
    }
}
