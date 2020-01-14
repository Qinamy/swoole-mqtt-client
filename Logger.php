<?php


class Logger implements \mqttclient\src\swoole\MqttLogInterface {

    public function log($type,$content,$params = []){
        echo "$type : $content \r\n";
    }
}
