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

namespace App\Controller;

use App\Middleware\UserAuthMiddleware;
use App\Services\Factory\UserService;
use App\Services\Job\QueueService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\Process\Annotation\Process;
use Hyperf\Swagger\Annotation as HA;
use Hyperf\Swagger\Annotation\Get;
use Psr\Http\Message\ResponseInterface;
use Qbhy\HyperfAuth\AuthManager;

#[HA\hyperfServer('http')]
#[AutoController]
#[Process(name: 'async-queue')]
class UserController extends Controller
{
    // 注解queue
    #[Inject]
    protected QueueService $service;

    #[Inject]
    private UserService $userService;

    #[Inject]
    private AuthManager $auth;

    #[HA\Post(path: '/login', description: '登录')]
    public function login(): ResponseInterface
    {
        $user = $this->userService->getUser(2);
        $token = $this->auth->guard('jwt')->login($user);
        return $this->response->success($token);
    }

    /**
     * @return \Swow\Psr7\Message\ResponsePlusInterface
     */
    #[Middleware(UserAuthMiddleware::class)]
    #[Get(path: '/test', description: '验证token')]
    public function testToken()
    {
        return $this->response->success($this->auth->guard('jwt')->user());
    }

    #[Get(path: '/queue/test', description: 'queue测试')]
    public function queueTest()
    {
        $this->service->push(['userId' => 2], 60);

        return $this->response->success('queue推送成功');
    }
}
