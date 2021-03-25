<?php

namespace AlphaSnow\AliyunOssThink\Tests;

use OSS\OssClient;
use Mockery;
use think\facade\Filesystem;

class DriverTest extends TestCase
{
    /**
     * @var OssClient
     */
    protected $ossClient;
    protected $filesystem;

    public function setUp(): void
    {
        parent::setUp();

        $ossClient = Mockery::mock(OssClient::class, function ($mock) {
            $mock->makePartial();
        });
        $this->app->instance(OssClient::class, $ossClient);
        $this->ossClient = $ossClient;

        $this->filesystem = Filesystem::disk('aliyun');
    }

    public function testPut()
    {
        $this->ossClient->shouldReceive([
            'putObject' => null,
            'doesObjectExist' => false,
        ]);

        $status = $this->filesystem->write('tests/foo.txt', 'bar');
        $this->assertTrue($status);
    }
}
