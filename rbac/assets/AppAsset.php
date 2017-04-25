<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use app\services\UrlService;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    // public $css = [
    //     '/bootstrap/css/bootstrap.min.css',
    // ];
    // public $js = [
    //     '/jquery/jquery.js',
    //     '/bootstrap/js/bootstrap.min.js',
    // ];
    // public $depends = [
    //     'yii\web\YiiAsset',
    //     'yii\bootstrap\BootstrapAsset',
    // ];

    //重写父类的方法
    public function registerAssetFiles($view)
    {
        $v= '201707022';
        //加一个版本号
        //加一个版本号,目的 ： 是浏览器获取最新的css 和 js 文件
        $this->css = [
            // '/bootstrap/css/bootstrap.min.css?v=20170425',
            "/bootstrap/css/bootstrap.min.css?v=$v",
            "/bootstrap/css/dashboard.css?v=$v",
            // UrlService::buildUrl(["/bootstrap/css/bootstrap.min.css"], ['v'=>$v]),
            // UrlService::buildUrl(["/bootstrap/css/dashboard.css"])
        ];
        
        $this->js = [
            '/jquery/jquery.js',
            '/bootstrap/js/bootstrap.min.js',
            // UrlService::buildUrl(["/jquery/jquery.js"]),
            // UrlService::buildUrl(["/bootstrap/js/bootstrap.min.js"])
        ];

        parent::registerAssetFiles($view);
    }
}
