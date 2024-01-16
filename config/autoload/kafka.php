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
use Hyperf\Kafka\Constants\KafkaStrategy;

return [
    'default' => [
        'enable' => true, // 是否启用 Kafka 连接
        'connect_timeout' => -1, // 连接超时时间（毫秒），-1 表示无限制
        'send_timeout' => -1, // 发送消息超时时间（毫秒），-1 表示无限制
        'recv_timeout' => -1, // 接收消息超时时间（毫秒），-1 表示无限制
        'client_id' => '', // 客户端 ID
        'max_write_attempts' => 3, // 最大写入尝试次数
        'bootstrap_servers' => [
            // 该配置需配合dockerfile kafka KAFKA_LISTENERS
            '192.168.110.254:9092',
        ], // Kafka 服务器地址列表
        'acks' => -1, // 确认级别
        'producer_id' => -1,
        'producer_epoch' => -1,
        'partition_leader_epoch' => -1,
        'interval' => 0,
        'session_timeout' => 60,
        'rebalance_timeout' => 60,
        'replica_id' => -1,
        'rack_id' => '', // 机架 ID
        'group_retry' => 5,
        'group_retry_sleep' => 1,
        'group_heartbeat' => 3,
        'offset_retry' => 5,
        'auto_create_topic' => true, // 是否自动创建主题
        'partition_assignment_strategy' => KafkaStrategy::RANGE_ASSIGNOR, // 分区分配策略
        'sasl' => [], // SASL 配置
        'ssl' => [], // SSL 配置
        'client' => \longlang\phpkafka\Client\SwooleClient::class, // 客户端类
        'socket' => \longlang\phpkafka\Socket\SwooleSocket::class, // Socket 类
        'timer' => \longlang\phpkafka\Timer\SwooleTimer::class, // 计时器类
        'consume_timeout' => 600, // 消费超时时间（秒）
        'exception_callback' => null, // 异常回调函数
    ],
];
