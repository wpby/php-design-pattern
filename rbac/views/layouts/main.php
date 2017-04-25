<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <!-- 导航栏 -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <a class="navbar-brand" href="#">RBAC</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" >
              <ul class="nav navbar-nav">
                <li class="active"><a href="/">首页链接</a></li>
              </ul>
              <?php if(isset($this->params['current_user']))?>
              <p class="navbar-text navbar-right">Hi,<?=$this->params['current_user']['name']?></p>
              <?php ?>
            </div>
        </div>
    </nav>

    <!-- 菜单栏-->
    <div class="container-fluid">
        <div class="col-sm-2 col-md-2 col-lg-2 sidebar">
            <ul class="nav nav-sidebar">
                <li>权限显示页面</li>
                <li><a href="javascript:void(0)">权限显示页面</a></li>
                <li><a href="#">测试页面1</a></li>
                <li><a href="#">测试页面2</a></li>
                <li><a href="#">测试页面3</a></li>
                <li><a href="#">测试页面4</a></li>
                <li><a href="#">测试页面5</a></li>

                <li>系统设置</li>
                <li><a href="javascript:void(0)">用户管理</a></li>
                <li><a href="#">角色管理</a></li>
                <li><a href="#">权限管理</a></li>
                
            </ul>
        </div>
         <!-- view区域-->
        <div class="col-sm-10 col-sm-offset-2 col-md-10 col-sm-lg-2 col-lg-10 col-sm-lg-2">
            <?=$content?>
            <hr>
            <footer>
                <p class="pull-left">RBAC权限管理</p>
                <p class="pull-right">Power By &copy闫绍杰</p>
            </footer>
        </div>
    </div>
   
    <div class=""></div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
