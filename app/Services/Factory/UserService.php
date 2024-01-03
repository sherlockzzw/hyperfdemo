<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Services\Factory;

use App\services\Dao\UserDao;
use Hyperf\Di\Annotation\Inject;

class UserService
{
    #[Inject]
    private UserDao $userDao;

    public function __construct(UserDao $userDao)
    {
        $this->userDao = $userDao;
    }

    public function createUser(array $data)
    {
        return $this->userDao->create($data);
    }

    public function getUser($id)
    {
        return $this->userDao->findById($id);
    }
}
