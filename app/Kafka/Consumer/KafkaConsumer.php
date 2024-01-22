<?php

declare(strict_types=1);

namespace App\Kafka\Consumer;

use App\Model\User;
use Hyperf\Kafka\AbstractConsumer;
use Hyperf\Kafka\Annotation\Consumer;
use longlang\phpkafka\Consumer\ConsumeMessage;

#[Consumer(topic: 'hyperf', groupId: 'hyperf', autoCommit: true, nums: 1)]
class KafkaConsumer extends AbstractConsumer
{
    public function consume(ConsumeMessage $message)
    {
        $data = json_decode($message->getValue(), true);
        $uid = $data['user_id'];
        var_dump('sssssssssss'.$uid);
        User::query()->where('id', $uid)->update(['nickname' => 'hyperf_kafka']);
    }
}
