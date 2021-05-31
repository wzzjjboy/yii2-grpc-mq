<?php


namespace alan\yii2_grpc_mq;


interface ISerialize
{
    public function serialize(array $data): array;

    public function unSerialize(array $data): array;
}