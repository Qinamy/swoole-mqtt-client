<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__.'/Logger.php';
require_once __DIR__.'/Store.php';

//use Logger;



$host = '127.0.0.1';
$port = 1883;

$r = new \mqttclient\src\swoole\MqttClient($host,$port,10017);
$r->setAuth('username','password');
$r->setKeepAlive(60);
$r->setLogger(new Logger()); // 日志
$r->setStore(new Store());   // 存储
$r->setTopics(
    [
        new \mqttclient\src\subscribe\Topic('slim',function($msg){
            echo "I receive:".$msg."\r\n";},1)
//        new \mqttclient\src\subscribe\Topic('test/slim3',function(\mqttclient\src\swoole\MqttClient $client,$msg){
//            echo "I receive:".$msg." for slim3 \r\n";
//            echo $client->getClientId();
//        )
    ]
);

//set trigger
$r->on(\mqttclient\src\consts\ClientTriggers::SOCKET_CONNECT,function(\mqttclient\src\swoole\MqttClient $client){
    $client->subscribe();
//    $client->publish('slim','test qos',0);
});
//$r->on(\mqttclient\src\consts\ClientTriggers::RECEIVE_CONNACK,function(\mqttclient\src\swoole\MqttClient $client){
//    $client->publish('test/slim','test qos',1);
//});
//$r->on(\mqttclient\src\consts\ClientTriggers::SOCKET_CONNECT,function(\mqttclient\src\swoole\MqttClient $client){
//    $client->subscribe();
//});
//$r->on(\mqttclient\src\consts\ClientTriggers::RECEIVE_CONNACK,function(\mqttclient\src\swoole\MqttClient $client){
//    $client->subscribe();
//});
//$r->on(\mqttclient\src\consts\ClientTriggers::RECEIVE_SUBACK,function(\mqttclient\src\swoole\MqttClient $client){
//    $client->publish('slim/echo','GGXX',\mqttclient\src\consts\Qos::LEAST_ONE_TIME);
//});


$r->connect();
//usleep(10000000);
