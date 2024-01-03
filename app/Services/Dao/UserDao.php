<?php

namespace App\Services\Dao;

use App\Model\User;

class UserDao
{
    public function create(array $data)
    {

    }

    public function findById($id)
    {
        return User::query()->find($id);
    }
}