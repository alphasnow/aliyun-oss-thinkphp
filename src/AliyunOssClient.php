<?php

namespace AlphaSnow\AliyunOssThink;

use OSS\OssClient;
use think\Facade as BaseFacade;

/**
 * Class AliyunOssClient
 * @package AlphaSnow\AliyunOss
 */
class AliyunOssClient extends BaseFacade
{
    public static function getFacadeAccessor()
    {
        return OssClient::class;
    }
}
