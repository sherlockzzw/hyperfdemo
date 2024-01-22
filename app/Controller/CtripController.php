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
use Hyperf\Swagger\Annotation as HA;

#[HA\hyperfServer('http')]
#[AutoController]
class CtripController extends Controller
{
    #[Get(path: '/ctrips/test', description: '协程')]
    public function tests()
    {

        Coroutine::create(function () {
            try {
                for ($i = 1; $i <= 10000; ++$i) {
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
//                var_dump($e->getMessage());
                //                var_dump($e->getTraceAsString());
            }
        });
        return $this->response->success('携程执行中');
    }

}
