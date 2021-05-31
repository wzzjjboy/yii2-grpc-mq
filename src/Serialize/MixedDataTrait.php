<?php


namespace alan\yii2_grpc_mq\Serialize;


trait MixedDataTrait
{
//    public $stringKeys = [];

    public function serialize(array $data): array
    {
        foreach ($data as $key => $value) {
            if (is_array($value)){
                $data[$key] = json_encode($value, JSON_UNESCAPED_UNICODE);
            }
        }
        return $data;
    }

    public function unSerialize(array $data): array
    {
        if (!empty($this->stringKeys)){
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->stringKeys) && false !== stripos("{", $value)){
                    $data[$key] = json_decode($value, true);
                }
            }
        }
        return $data;
    }
}