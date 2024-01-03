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

namespace App\Middleware;

use Hyperf\Di\Annotation\Inject;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Qbhy\HyperfAuth\Authenticatable;
use Qbhy\HyperfAuth\AuthManager;
use Qbhy\HyperfAuth\AuthMiddleware;
use Qbhy\HyperfAuth\Exception\UnauthorizedException;

class UserAuthMiddleware extends AuthMiddleware implements MiddlewareInterface
{
    protected array $guards = ['jwt'];

    #[Inject(AuthManager::class)]
    protected AuthManager $auth;

    public function __construct(protected ContainerInterface $container)
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $guard = $this->auth->guard('jwt');

        if (! $guard->user() instanceof Authenticatable) {

            throw new UnauthorizedException("Without authorization from {$guard->getName()} guard", $guard);
        }
        return $handler->handle($request);
    }
}
