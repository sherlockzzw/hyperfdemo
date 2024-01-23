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

namespace App\Job;

use App\Model\User;
use Hyperf\AsyncQueue\Job;

class TestJob extends Job
{
    public mixed $params;

    protected int $maxAttempts = 2;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function handle()
    {
        User::query()->where('id', $this->params['userId'])->update(['nickname' => 'aaaaaaaaaa']);
    }
}
