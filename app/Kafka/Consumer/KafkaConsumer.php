<?php

declare(strict_types=1);

namespace App\Kafka\Consumer;

use Hyperf\Kafka\AbstractConsumer;
use Hyperf\Kafka\Annotation\Consumer;
use longlang\phpkafka\Consumer\ConsumeMessage;

#[Consumer(topic: 'hyperf', groupId: 'hyperf', autoCommit: true, nums: 1)]
class KafkaConsumer extends AbstractConsumer
{
    public function consume(ConsumeMessage $message)
    {
        var_dump($message->getTopic() . ':' . $message->getKey() . ':' . $message->getValue());
    }
}
