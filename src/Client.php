<?php


namespace alan\yii2_grpc_mq;


use MqManage\MqManageClient;
use yii\base\BaseObject;

class Client extends BaseObject
{
    public $uri;
    public $timeout = 10;
    public $appName = '';

    public function Publish(string $calledClass, $taskName, array $taskData, \Closure $failCallback = null, \Closure $successCallback = null)
    {
        \Swoole\Coroutine::create(function () use ($calledClass, $taskName, $taskData, $failCallback, $successCallback) {
            $client = new MqManageClient($this->uri);
            $client->setTimeout($this->timeout);
            $request = new \MqManage\PublishRequest();
            $request->setAppName($this->appName);
            $request->setTaskName($taskName);
            $reflectionClass = new \ReflectionClass($calledClass);
            if($reflectionClass->implementsInterface(ISerialize::class)){
                /** @var ISerialize $instance */
                $instance = $reflectionClass->newInstanceWithoutConstructor();
                $taskData = $instance->serialize($taskData);
            }
            pr($taskData);
            $request->setTaskData($taskData);
            try {
                /** @var \MqManage\PublishResponse $reply */
                list($reply) = $client->publish($request);
                $client->close();
                if (is_object($reply)){
                    $code = $reply->getCode();
                    $message = $reply->getMsg();
                    $successCallback($code, $message);
                } else {
                    $failCallback(1, $reply);
                }
            }catch (\Exception $exception){
                $failCallback(2, $exception->getMessage());
            }
        });
    }
}