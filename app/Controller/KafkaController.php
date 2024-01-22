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

use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\Kafka\Producer;
use Hyperf\Swagger\Annotation as HA;
use Hyperf\Swagger\Annotation\Get;

#[HA\hyperfServer('http')]
#[AutoController]
class KafkaController extends Controller
{
    #[Get(path: '/kafka/test', description: 'kafka测试')]
    public function kafkaTest(Producer $producer)
    {
        $key = 'user_key';
        $value = json_encode(['user_id' => 2]);
        $producer->send('hyperf', $value, $key);
        return $this->response->success('kafka测试成功');
    }
}
