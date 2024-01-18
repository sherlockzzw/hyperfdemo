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

use Hyperf\DbConnection\Db;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\Swagger\Annotation\Get;
use Swoole\Coroutine;
use Throwable;

#[AutoController]
class CtripController extends Controller
{
    #[Get(path: '/ctrip/test', description: '携程')]
    public function test()
    {
        Coroutine::create(function () {
            try {
                for ($i = 1; $i <= 11000; ++$i) {
                    $data[] = [
                        'nickname' => 'nickname' . $i,
                        'email' => 'email' . $i,
                        'password' => 'password' . $i,
                        'avatar' => 'avatar' . $i,
                        'status' => 'normal',
                    ];
                }

                Db::table('users')->insert($data);
            } catch (Throwable $e) {
                var_dump($e->getMessage());
                //                var_dump($e->getTraceAsString());
            }
        });
        return $this->response->success('携程执行中');
    }
}
