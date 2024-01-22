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
use Hyperf\Logger\LoggerFactory;
use Hyperf\Swagger\Annotation as HA;
use Hyperf\Swagger\Annotation\Get;

#[AutoController]
#[HA\hyperfServer('http')]
class LogController extends Controller
{
    #[Get(path: '/log/test',  description: '日志')]
    public function logTest(LoggerFactory $loggerFactory)
    {
        var_dump('sssssssssssssssss');
        $logger = $loggerFactory->get('default');
        $message = 'Log message';

        // 将日志写入到 info.log 文件中
        $logger->info($message);

        // 将日志写入到 error.log 文件中
        $logger->error($message);
        return $this->response->success('日志写入成功');
    }
}
