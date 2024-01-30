<?php

declare(strict_types=1);

namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

#[Constants]
class ErrorCode extends AbstractConstants
{
    /**
     * @Message("Server Error！")
     */
    const SERVER_ERROR = 500;

    /**
     * @Message("系统参数错误")
     */
    const SYSTEM_INVALID = 700;
}
