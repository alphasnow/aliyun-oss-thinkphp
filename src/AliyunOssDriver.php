<?php

namespace AlphaSnow\AliyunOssThink;

use League\Flysystem\AdapterInterface;
use League\Flysystem\Filesystem;
use think\filesystem\Driver;
use think\Container;

/**
 * Class AliyunOssDriver
 * @package AlphaSnow\AliyunOssThink
 * @mixin Filesystem
 */
class AliyunOssDriver extends Driver
{
    /**
     * 配置参数
     * @var array
     */
    protected $config = [
        'root' => '',
        'disable_asserts' => true,
    ];

    protected function createAdapter(): AdapterInterface
    {
        return Container::getInstance()->get('aliyun-oss.adapter');
    }
}
