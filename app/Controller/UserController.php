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
use Hyperf\Swagger\Annotation as HA;
use Hyperf\Swagger\Annotation\Get;
use Psr\Http\Message\ResponseInterface;
use Qbhy\HyperfAuth\AuthManager;


#[HA\hyperfServer('http')]
#[AutoController]
class UserController extends Controller
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
        return $this->response->success($token);
    }

    #[Middleware(UserAuthMiddleware::class)]
    #[Get(path: '/test', description: '验证token')]
    public function testToken()
    {
        return $this->response->success($this->auth->guard('jwt')->user());
    }


}
