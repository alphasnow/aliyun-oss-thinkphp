<?php

namespace AlphaSnow\AliyunOssThink\Tests;

use AlphaSnow\AliyunOssThink\AliyunOss;
use think\facade\Filesystem;

class FacadeTest extends TestCase
{
    public function testInstance()
    {
        $aliyunOss = AliyunOss::instance();
        $aliyunFilesystem = Filesystem::disk('aliyun');

        $this->assertTrue($aliyunOss == $aliyunFilesystem);
    }
}
