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
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\Kafka\Producer;
use Hyperf\Swagger\Annotation as HA;
use Psr\Http\Message\ResponseInterface;
use Qbhy\HyperfAuth\AuthManager;

#[HA\hyperfServer('http')]
#[AutoController]
class UserController extends AbstractController
{
    #[Inject]
    private UserService $userService;

    #[Inject]
    private AuthManager $auth;

    #[HA\Post(path: '/login', description: '登录')]
    public function login(): ResponseInterface
    {
        $user = $this->userService->getUser(2);
        $token = $this->auth->guard('jwt')->login($user);
        return $this->success($token);
    }

    #[Middleware(UserAuthMiddleware::class)]
    #[HA\Get(path: '/test', description: '验证token')]
    public function testToken()
    {
        return $this->response->json(['code' => 200, 'message' => 'success', 'data' => $this->auth->guard('jwt')->user()]);
    }

    #[HA\Get(path: '/kafka/test', description: '测试kafka')]
    public function kafkaTest(Producer $producer)
    {
        $producer->send('hyperf', 'hyperf', 'key');

    }
}
