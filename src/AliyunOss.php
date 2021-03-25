<?php

namespace AlphaSnow\AliyunOssThink;

use think\Facade;

class AliyunOss extends Facade
{
    protected static function getFacadeClass()
    {
        return AliyunOssDriver::class;
    }
}
