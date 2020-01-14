<?php


class Store implements \mqttclient\src\swoole\TmpStorageInterface{

    private $data = [];

    public function set($message_type, $key, $sub_key, $data, $expire = 3600)
    {
        $this->data[$message_type][$key][$sub_key] = $data;
    }

    public function get($message_type, $key, $sub_key)
    {
        return $this->data[$message_type][$key][$sub_key];
    }

    public function delete($message_type, $key, $sub_key)
    {
        if (!isset($this->data[$message_type][$key][$sub_key])){
            echo "storage not found:$message_type $key $sub_key";
        }
        unset($this->data[$message_type][$key][$sub_key]);
    }

}
