<?php

namespace App\Services\SubService;

use App\Model\User;
use Hyperf\Redis\Redis;
use Hyperf\Support\Traits\StaticInstance;

class UserAuth
{
    use StaticInstance;

    const PREFIX = 'auth:';

    public function __construct(User $user)
    {

    }
}