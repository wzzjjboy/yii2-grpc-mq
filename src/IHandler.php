<?php


namespace alan\yii2_grpc_mq;


interface IHandler
{
    public function getRoute(): string;

    public function handler(string $appName, string $taskName, array $data): bool;
}