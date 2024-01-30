<?php

namespace App\Controller;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\Swagger\Annotation as HA;
#[AutoController]
#[HA\hyperfServer('http')]
class Exception extends Controller
{
    #[HA\Get(path: '/exception', description: '异常测试')]
    public function error()
    {
        throw new BusinessException(ErrorCode::SYSTEM_INVALID);
    }
}