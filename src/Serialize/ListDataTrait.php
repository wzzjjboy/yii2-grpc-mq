<?php


namespace alan\yii2_grpc_mq\Serialize;


trait ListDataTrait
{

    public $mapKey = "__1__";

    public function serialize(array $data): array
    {
        return [$this->mapKey => json_encode($data, JSON_UNESCAPED_UNICODE)];
    }

    public function unSerialize(array $data): array
    {
        return json_decode($data[$this->mapKey], true);
    }
}