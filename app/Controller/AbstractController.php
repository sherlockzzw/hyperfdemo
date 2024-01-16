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

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Container\ContainerInterface;

abstract class AbstractController
{
    #[Inject]
    protected ContainerInterface $container;

    #[Inject]
    protected RequestInterface $request;

    #[Inject]
    protected ResponseInterface $response;

//    protected function success($data = [], string $message = 'Success', int $code = 200)
//    {
//        return $this->response->json([
//            'code' => $code,
//            'message' => $message,
//            'data' => $data,
//        ]);
//    }
//
//    protected function error(string $message = 'Error', int $code = 500, $data = [])
//    {
//        return $this->response->json([
//            'code' => $code,
//            'message' => $message,
//            'data' => $data,
//        ]);
//    }
}
