<?php
/**
 * Singleton class
 */
final class Product
{
 
    /**
     * @var self
     */
    private static $instance;
 
    /**
     * @var mixed
     */
    public $mix;
 
 
    /**
     * Return self instance
     *
     * @return self
     */
    public static function getInstance() {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
 
    private function __construct() {
    }
 
    private function __clone() {
    }
}
 
$firstProduct = Product::getInstance();
$secondProduct = Product::getInstance();
 
$firstProduct->mix = 'test<br>';
$secondProduct->mix = 'example<br>';
 
var_dump($firstProduct==$secondProduct);
echo '<br>';
// example
print_r($secondProduct->mix);

class test
{
    final function aa()
    {
        echo 's<br>';
    }
}

$test = new test();
$test->aa();

class testExtend extends test
{
    //final方法不能被重构
    // function aa()
    // {
    //     echo '重构aa方法';
    // }
}

$test = new testExtend();
$test->aa();


final class test1
{
    function aa()
    {
        echo 'final类不能够继承';
    }
}

// class test2 extends test1
// {

// }

//define定义常量,不能在类中使用
define('test' ,1);
echo '常量结果是:'.test.'<br>';
// echo '常量结果是:'.test++;

//在类里面定义常量用 const 关键字，而不是通常的 define() 函
class test3 
{
    const a = 1;
    function __construct()
    {
        echo '类定义的常量：'.self::a.'<br>';
    }
}

new test3();
new test3();
$test = new test3();
// echo $test->a;

function test1($a, $b)
{
    echo $a.'--'.$b;
}
//特别的调用函数的方法
call_user_func('test1', 1, 2);

class test4
{
    static function test($a, $b)
    {
        echo '结果a'.$a.'--b'.$b.'<br>';
    }
}
call_user_func(['test4', 'test'], '闫绍杰', '测试');

function test2($a, $b)
{
    echo 'call_user_func_array结果:'.$a.'--'.$b.'<br>';
}

call_user_func_array('test2', ['a', 'b']);

class test333
{
    static function test($a, $b)
    {
        echo '类的call_user_func_array结果是: '.$a.'--'.$b.'<br>';
    }
}

call_user_func_array(['test333', 'test'], ['ysj', 'tt']);