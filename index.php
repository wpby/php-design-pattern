<?php

//定义常量,根目录
define('BASEDIR', __DIR__);
include BASEDIR."/IMooc/Loader.php";
spl_autoload_register("\\IMooc\\Loader::autoload");


IMooc\Object::index();
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

//栈结构，先进后出
$stack = new SplStack();
$stack->push('data1\n');
$stack->push("data2\n");

// echo '先出来的是:'.$stack->pop().' ';
// echo '后出来的是：'.$stack->pop()." ";

//队列,是先进先出
$queue = new SplQueue();
$queue->enqueue('test1');
$queue->enqueue('test2');

// echo '先出的是:'.$queue->dequeue();
// echo '后出的是:'.$queue->dequeue().'<br>';

//堆(堆(Heap)就是为了实现优先队列而设计的一种数据结构)
$heap = new SplMinHeap();//最小堆使用
$heap->insert('data1');
$heap->insert('data2');

// echo '结果1是:'.$heap->extract().' ';
// echo ' 结果2是:'.$heap->extract();

//固定长度的数组,超出长度会报错,没有定义的地方为空
$arr = new SplFixedArray(3);
$arr[0] = '打塔1';
$arr[1] = '打塔2';
// var_dump($arr);

//php链接式操作的最关键一步是:不是最后一步的操作函数中必须return $this,即返回本对象，以调用后续的方法和使用
// $data = new IMooc\Database();
// $data->where('id=1')->where('name=ysj')->order('id desc')->limit(10);

//__get和__set
//对象是类的实例化（实例化类）
$object = new IMooc\Object();
//对象的这个属性不存在
$object->title = '杰绍闫';
// echo '标题是:'.$object->title;

//调用不存在的方法
// echo $object->test('sdf', '是');
//调用不存在的静态方法
IMooc\Object::test('有数据', '打塔1');

//输出对象，因为有__toString方法所以，不会报错。
// echo $object;
//把一个对象当场一个函数去执行
// $object('1');

//三种基础设计模式
//工厂模式 使用一个工厂方法或者类生成对象。而不是在代码中new对象
//单例模式 使某个类的对象仅能创建一次，（需要一个保存类的唯一实例的私有静态成员变量
// 构造函数必须声明为私有的，防止外部程序new一个对象从而失去单例的意义
// 克隆函数必须声明为私有的，防止对象被克隆
// 必须提供一个访问这个实例的公共静态方法---通常命名为getInstance，从而返回唯一实例的一个引用)
//注册树模式 解决全局共享和交换对象

// 微观来说：工厂就是容易修改，单例就是节约资源，注册就是方便操作
// 宏观就是：高内聚，低耦合，约定俗成，统一管理，可读性强，增加代码复用性


//没有使用工厂模式，需要new 对象();
// $data = new IMooc\Database();
// $data->test();
//使用工厂模式
$data = IMooc\Factory::createDatabase('Database');
$data->test();

// echo IMooc\Factory::test('测试一下呗');

//单例模式
// $data = IMooc\Database::getInstance();
// echo $data->test();

//注册树模式,需要先注册到注册树才能取到结果
$data = IMooc\Register::get('db1');
// echo $data->test();

//策略模式,将一组特定的行为和算法封装成类。以适应某些特定性的上下文环境

class page
{
	protected $strategy;
	public function index()
	{
		echo 'ad：';
		$this->strategy->showAd();
		echo '类目：';
		$this->strategy->showCategory();
	}

	//设置策略，传入策略对象
	public function setStrategy(\IMooc\UserStrategy $userStrategy)
	{
		$this->strategy = $userStrategy;
	}
}

$page = new Page();

if(isset($_GET['male'])){
	$strategy = new IMooc\Male();
}else{
	$strategy = new IMooc\Female();
}
//传入策略对象
$page->setStrategy($strategy);
$page->index();

//适配器模式，可以将截瘫不同的函数接口封装成统一的API
$db = new IMooc\Database\Mysqli;
$db->connect('localhost', 'homestead', 'secret', 'ysj');
var_dump($db->query('show databases'));
$db->close();

//数据对象映射模式
// $user = new IMooc\User(4);
// var_dump($user->id, $user->name);
//自动更新表数据
// $user->name = 'ysj';
// $user->email = '1@qq.com';


class dataObject
{


	public function index()
	{
		//new 对象，目前没有使用工厂方法，
		//如果没有使用工厂方法的话，如果一旦类的名称发生改变的时候或者参数进行变动
		//程序中使用这个类的关联都需要进行手动改变
		//建议使用工厂方法进行操作，而不是new 对象
		// $user = new IMooc\User(1);
		echo '1';
		//这个使用是工厂方法生成对象,不是在代码中去new
		$user = IMooc\Factory::getUser(1);
		var_dump($user);
		$user->name = '闫绍杰';
		$this->test1();
		// $this->test2($user);
	}

	//初始化的时候没有user对象
	public function test1()
	{
		echo 'test1';
		$user = IMooc\Factory::getUser(1);
		//然而test()方法中的邮箱没有保存成功,
		//是因为email的值被index()方法中User对象的email覆盖掉了
		var_dump($user);
		$user->email = 'test1@qq.com';
	}

	//参数传递这个对象,缺点是很多方法需要操作这个对象就不方便了
	//所以要改进，工厂模式中新增注册器模式
	public function test2($user)
	{
		echo 'test2';
		// var_dump($user);
		$user->email = 'test2@qq.com';
	}
}

echo '<br>调用了dataObject类<br>';
$data = new dataObject();
$data->index();