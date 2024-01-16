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

use App\RedisAgency\UserRedis;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\Swagger\Annotation as HA;
use Hyperf\Swagger\Annotation\Get;

#[HA\hyperfServer('http')]
#[AutoController]
class CacheController extends Controller
{

    #[Get(path: '/cache/test', description: 'cache测试')]
    public function cacheTest()
    {
        $redis = $this->container->get(UserRedis::class);
        $redis->set('hyperf', 'hellow hyperf');

        $data = $redis->get('hyperf');
        return $this->response->success($data ?? []);
    }
}
