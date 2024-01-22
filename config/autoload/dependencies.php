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
use App\Controller\UserController;
use App\Services\Factory\UserService;

return [
    'dependencies' => [
        'definitions' => [
            UserController::class => UserController::class,
            UserService::class => UserService::class,
            EasyWeChat\MiniApp\Contracts\Application::class => App\Services\Factory\WeahctFactory::class,
        ],
    ],
];
