<?php


namespace alan\yii2_grpc_mq;


class Utils
{
    /**
     * 任务处理类名转任务名
     * @param string $class
     * @return string
     */
    public static function classToTaskName(string $class): string
    {
        if (($pos = strripos($class, '\\')) === false){
            return self::toUnderScore($class);
        }
        return self::toUnderScore(substr($class, $pos+1));
    }

    /**
     * 任务名转处理类
     * @param string $taskName 任务名称
     * @param string $pNamespace 父命名空间
     * @return string
     */
    public static function taskNameToClass(string $taskName, string $pNamespace): string
    {
        return sprintf("%s\\%s", self::getPNamespace($pNamespace), ucfirst(self::toCamelCase($taskName)));
    }

    //驼峰命名转下划线命名
    private static function toUnderScore($str)
    {
        $dstr = preg_replace_callback('/([A-Z]+)/', function ($matchs) {
            return '_' . strtolower($matchs[0]);
        }, $str);
        return trim(preg_replace('/_{2,}/', '_', $dstr), '_');
    }

    //下划线命名到驼峰命名
    private static function toCamelCase($str)
    {
        $array = explode('_', $str);
        $result = $array[0];
        $len = count($array);
        if ($len > 1) {
            for ($i = 1; $i < $len; $i++) {
                $result .= ucfirst($array[$i]);
            }
        }
        return $result;
    }

    private static function getPNamespace(string $namespace)
    {
        return substr($namespace, 0, strripos($namespace, '\\'));
    }
}