<?php
// GENERATED CODE -- DO NOT EDIT!

namespace MqManage;

/**
 */
class MqManageClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts = []) {
        parent::__construct($hostname, $opts);
    }

    /**
     * @param \alan\yii2_grpc_mq\MqManage\PublishRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function publish(\MqManage\PublishRequest $argument,
                            $metadata = [], $options = []) {
        return $this->_simpleRequest('/mqManage.MqManage/publish',
        $argument,
        ['\MqManage\PublishResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \alan\yii2_grpc_mq\MqManage\ConsumeRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function consume(\MqManage\ConsumeRequest $argument,
                            $metadata = [], $options = []) {
        return $this->_simpleRequest('/mqManage.MqManage/consume',
        $argument,
        ['\MqManage\ConsumeResponse', 'decode'],
        $metadata, $options);
    }

}
