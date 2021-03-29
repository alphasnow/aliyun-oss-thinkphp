<?php

namespace AlphaSnow\AliyunOssThink;

use think\Facade as BaseFacade;

/**
 * @see \OSS\OssClient
 */
class AliyunOssClient extends BaseFacade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'aliyun-oss.client';
    }
}
