# Aliyun-oss-filesystem for ThinkPHP

扩展借鉴了一些优秀的代码，综合各方，同时做了更多优化，将会添加更多完善的接口和插件，打造ThinkPHP最好的OSS Filesystem扩展

## 运行环境
- PHP 7.0+
- cURL extension
- ThinkPHP 6.0+

## 安装方法
1. 如果您通过composer管理您的项目依赖，可以在你的项目根目录运行：

        $ composer require alphasnow/aliyun-oss-thinkphp

   或者在你的`composer.json`中声明依赖：

        "require": {
            "alphasnow/aliyun-oss-thinkphp": "~1.0"
        }

2. 修改环境文件`.env`
    ```
    ALIYUN_OSS_ACCESS_ID=
    ALIYUN_OSS_ACCESS_KEY=
    ALIYUN_OSS_BUCKET=
    ALIYUN_OSS_ENDPOINT=oss-cn-shanghai.aliyuncs.com
    ALIYUN_OSS_IS_CNAME=false
    ALIYUN_OSS_CDN_DOMAIN=
    ALIYUN_OSS_SSL=false
    ```

## 快速使用

#### 文件上传
```php
use think\facade\Filesystem;
$file = request()->file('image');
$savename = Filesystem::disk('aliyun')->putFile( 'image', $file);
```

> https://www.kancloud.cn/manual/thinkphp6_0/1037639

#### 文件写入
```php
use think\facade\Filesystem;
$filesystem = Filesystem::disk('aliyun');

$filesystem->write('prefix/path/file.txt',file_get_contents('/local/path/file.txt'));
```

> [阿里云OSS文档](https://help.aliyun.com/document_detail/32099.html?spm=5176.doc31981.6.335.eqQ9dM)

## License
See [LICENSE](LICENSE).