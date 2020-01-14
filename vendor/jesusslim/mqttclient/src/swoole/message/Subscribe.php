<?php
/**
 * Created by PhpStorm.
 * User: jesusslim
 * Date: 2017/8/3
 * Time: 下午8:26
 */

namespace mqttclient\src\swoole\message;


use mqttclient\src\consts\MessageType;
use mqttclient\src\swoole\Util;

class Subscribe extends BaseMessage
{

    protected $type = MessageType::SUBSCRIBE;

    protected $need_message_id = true;

    protected $reserved_flags = 0x02;   // 订阅必须要Qos = 1 

    public function getPayload()
    {
        $buffer = "";
        $topics = $this->getClient()->getTopics();
//        echo '@@getPayload'.PHP_EOL;
//        echo   json_encode($topics).PHP_EOL;
        /* @var \mqttclient\src\subscribe\Topic $topic */
        foreach ($topics as $topic_name => $topic){
//            echo $topic->getTopic().PHP_EOL;
            $buffer .= Util::packLenStr($topic->getTopic());
//            echo Util::packLenStr($topic->getTopic()).PHP_EOL;
//            $buffer .= $topic->getTopic();
            $buffer .= chr($topic->getQos());
//            echo $topic->getQos().PHP_EOL;
//            echo chr($topic->getQos()).PHP_EOL;
        }

        return $buffer;
    }

}