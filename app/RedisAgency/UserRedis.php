<?php

namespace App\RedisAgency;

use Hyperf\Redis\Redis;

class UserRedis extends Redis
{
    protected string $poolName = 'UserRedis';
}