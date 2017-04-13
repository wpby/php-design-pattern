<?php

//定义常量,根目录
define('BASEDIR', __DIR__);
include BASEDIR.'/IMooc/Loader.php';
spl_autoload_register('\\IMooc\\Loader::autoload');


IMooc\Object::test();
App\Controllers\Home\Index::test();
// PSR-0规范
// 1.命名空间必须与绝对路径一致
// 2.类名首字母必须大写
// 3.除了入口文件外，其他'.php'必须只有一个类

// 开发符合PSR-O规范的基础框架
// 1.全部必须使用命名空间
// 2.所有php文件必须自动载入,不能有include/require
// 3.单一入口，也就是index.php
// 4.类型和文件名必须保持一致
// 5.命名空间要跟文件夹目录保持一致


//适配器模式，可以将截瘫不同的函数接口封装成统一的API
$db = new IMooc\Database\Mysqli;
$db->connect('localhost', 'homestead', 'secret', 'ysj');
var_dump($db->query('show databases'));
$db->close();
