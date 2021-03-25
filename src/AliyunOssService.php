<?php

namespace AlphaSnow\AliyunOssThink;

use think\Cache;
use think\Service as BaseService;
use Aliyun\Flysystem\AliyunOss\Plugins\PutFile;
use League\Flysystem\Config;
use League\Flysystem\Filesystem;
use OSS\OssClient;

class AliyunOssService extends BaseService
{
    protected function setupConfig()
    {
        $appConfig = $this->app->get('config');
        if (!$appConfig->has('filesystem.disks.aliyun')) {
            $filesystemConfig = $appConfig->get('filesystem');
            if ($appConfig->has('aliyun-oss')) {
                $filesystemConfig['disks']['aliyun'] = $appConfig->get('aliyun-oss');
            } else {
                $filesystemConfig['disks']['aliyun'] = require __DIR__.'/config/config.php';
            }
            $filesystemConfig['disks']['aliyun']['type'] = AliyunOssDriver::class;
            $appConfig->set($filesystemConfig, 'filesystem');
        }
    }
    public function boot()
    {
        $this->setupConfig();
    }

    public function register()
    {
        $this->app->bind(AliyunOssDriver::class, function () {
            $cache = $this->app->get(Cache::class);
            $config = $this->app->get('config')->get('filesystem.disks.aliyun');
            $driver = new AliyunOssDriver($cache, $config);
            return $driver;
        });
        $this->app->bind('aliyun-oss.driver', AliyunOssDriver::class);

        $this->app->bind('aliyun-oss.filesystem', function () {
            $adapter = $this->app->get('aliyun-oss.adapter');

            $filesystem = new Filesystem($adapter, new Config(['disable_asserts' => true]));
            $filesystem->addPlugin(new PutFile());

            return $filesystem;
        });

        $this->app->bind('aliyun-oss.adapter', function () {
            $config = $this->app->get('config')->get('filesystem.disks.aliyun');
            $client = $this->app->get(OssClient::class);

            $adapter = new AliyunOssAdapter($config, $client);

            return $adapter;
        });

        $this->app->bind(OssClient::class, function () {
            $config = $this->app->get('config')->get('filesystem.disks.aliyun');
            return new OssClient(
                $config['accessId'],
                $config['accessKey'],
                $config['endpoint'],
                $config['isCname'],
                $config['securityToken']
            );
        });
        $this->app->bind('aliyun-oss.client', OssClient::class);
    }
}
