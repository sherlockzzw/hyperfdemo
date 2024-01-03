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

namespace App\Exception\Handler;

use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Qbhy\HyperfAuth\Exception\UnauthorizedException;
use Swow\Psr7\Message\ResponsePlusInterface;
use Throwable;

class AuthExceptionHandler extends ExceptionHandler
{
    public function handle(Throwable $throwable, ResponsePlusInterface $response)
    {
        if ($throwable instanceof UnauthorizedException) {
            $data = json_encode([
                'code' => $throwable->getCode(),
                'message' => $throwable->getMessage(),
            ], JSON_UNESCAPED_UNICODE);

            $this->stopPropagation();
            return $response->withStatus(500)->withBody(new SwooleStream($data));
        }

        return $response;

    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
