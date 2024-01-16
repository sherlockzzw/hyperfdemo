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

use App\Listener\FooRedis;
use App\Middleware\UserAuthMiddleware;
use App\RedisAgency\UserRedis;
use App\Services\Factory\UserService;
use Hyperf\Context\ApplicationContext;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\Kafka\Producer;
use Hyperf\Swagger\Annotation as HA;
use Hyperf\Swagger\Annotation\Get;
use Psr\Http\Message\ResponseInterface;
use Psr\SimpleCache\CacheInterface;
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

    #[Get(path: '/kafka/test', description: '测试kafka')]
    public function kafkaTest(Producer $producer)
    {
        $producer->send('hyperf', 'hyperf', 'key');
    }

    #[Get(path: '/cache/test', description: '测试cache')]
    public function cacheTest()
    {

        $redis = $this->container->get(UserRedis::class);
        $redis->set('hyperf','hellow hyperf');
        $data = $redis->get('hyperf');
        return $this->response->success($data ?? []);
    }

}
