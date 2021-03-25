<?php

namespace AlphaSnow\AliyunOssThink\Tests;

use AlphaSnow\AliyunOssThink\AliyunOssService;
use PHPUnit\Framework\TestCase as BaseTestCase;
use think\App;
use think\Cache;
use think\cache\Driver;

/**
 *
 * Class TestCase
 * @package AlphaSnow\AliyunOss\Tests
 */
class TestCase extends BaseTestCase
{
    protected $app;
    public function setUp()
    {
        parent::setUp();

        $this->app = new App();

        $store = \Mockery::mock(Driver::class)->makePartial();
        $cache = \Mockery::mock(Cache::class)->makePartial();
        $cache->shouldReceive('store')->with(null)->andReturn($store);
        $this->app->instance(Cache::class, $cache);

        $this->app->register(AliyunOssService::class);

        $this->app->http->run();
//        $this->app->console->run();
    }
}
