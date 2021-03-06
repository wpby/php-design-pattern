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
// $data->index();

/**
 * 观察者模式observer
 * 当一个对象状态发生改变时,依赖它的对象全部会收到通知。并自动更新
 * 观察者模式实现了低耦合，非入侵式的通知和更新机制
 *继续事件发生者 
 */

class event extends IMooc\EventGenerator
{
	//表示触发了一个新的事件
	function tigger()
	{
		echo 'Event<br>';
		//传统模式直接写update 操作
		// echo '逻辑1<br>';
		// echo '逻辑2<br>';
		// echo '逻辑3<br>';
		// echo '逻辑4<br>';
		//事件发生后，调用基类 的notify,通知所有观察者执行更新
		$this->notify();
	}
}
//观察者1,继承接口。继承用implemets
class Observer1 implements IMooc\Observer
{
	function update($event_info = null)
	{
		echo '哈哈，成功了--';
		echo '逻辑1<br>';
	}
}
//观察2
class Observer2 implements IMooc\Observer
{
	function update($event_info =null)
	{
		echo 'success2--';
		echo '逻辑2<br>';
	}
}

$event = new event();
//增加观察者1
$observer1 = new Observer1();
$event->addObserver($observer1);
//增加观察者2
$event->addObserver(new Observer2());
$event->tigger();

/**
 * 原型模式 
 * 跟工厂模式作用类似，都是用来创建对象
 * 与工厂模式的实现不同，原型模式是先创建好一个原型对象
 * 然后clone原型对象来创建新的对象，这样就免去了类创建时重复的初始化操作
 * 原型模式使用与大对象的创建。创建一个大对象需要很大的开销。如果每次new就会消耗很大，
 * 原型模式仅需内存拷贝即可
 * 
 */
$canvas1 = new IMooc\Canvas();
$canvas1->init();
//画一个矩形
$canvas1->rect(3, 6, 4, 12);
$canvas1->draw();
//绘制两个图形，传统方式需要new两次，分别进行描述,很占资源
echo '<br>';
$canvas2 = new IMooc\Canvas();
$canvas2->init();
//画一个矩形
$canvas2->rect(3, 6, 4, 12);
$canvas2->draw();

//原型对象
$prototype = new IMooc\Canvas();
$prototype->init();
/*建立原型对象结束*/
//需要多个画布的时候，不在需要new IMooc\Canvas();

//画布1
$canvas1 = clone $prototype;
$canvas1->rect(3, 6, 4, 12);
$canvas1->draw();
//画布2
$canvas2 = clone $prototype;
$canvas2->rect(3, 6, 4, 12);
$canvas2->draw();

/**
 * 1.装饰器模式以动态的添加修改类的功能
 * 2.一个类提供了一项功能,如果要在修改并添加额外的功能，传统的编程模式
 * 需要写一个子类并集成它。并重新实现类的方法
 * 3.使用装饰器模式，仅需在运行时添加一个装饰器对象即可实现，
 * 可以实现最大的灵活性
 */
//策略模式侧重于IOC实现解耦
//装饰器侧重不用继承和修改原对象下，可以动态修改类的功能

/**
 * 假如要修改canvas类中的draw方法。下面是传统方法
 */
class canvasChild extends IMooc\Canvas
{
	public function draw()
	{
		echo '<div style="color:red;">';
		parent::draw();
		echo '</div>';
	}
}
echo '传统编程模式开始:<br>';
$canvas = new IMooc\Canvas();
$canvas->init();
$canvas->rect(3, 6, 4, 12);
$canvas->draw();
echo '传统编程模式结束:<br>';
echo '装饰器模式开始:<br>';
//实现装饰器的调用
$canvas = new IMooc\Canvas();
//调用canvas里面的添加装饰器方法
$canvas->init();
//增加颜色装饰器
$canvas->addDecorator(new IMooc\ColorDrawDecorator("green"));
//增加字体大小装饰器
$canvas->addDecorator(new IMooc\SizeDecorator("39px"));
$canvas->draw();
echo '装饰器模式结束:<br>';

/**
 * 代理模式
 * 1.在客户端与实体之间建立一个代理对象(proxy),客户端对实体进行操作
 * 全部委派为代理对象，隐藏实体的具体实现细节
 * 2. proxy还可以与业务代码分离，部署到另外的服务器。业务代码中通过RPC(远程调用其他服务器)来委派任务
 * 
 */
$proxy = new IMooc\Proxy();
$proxy->getUserName(1);
$proxy->setUserName(1, '代理模式');


/**
 * 1.迭代器模式，在不需要了解内部实现的前提下，遍历一个聚合对象的内部元素
 * 2. 相比于传统的编程模式，迭代器模式可以隐藏遍历元素的所需的操作
 */
$users = new IMooc\AllUser();
foreach($users as $user){
	var_dump($user->name);
	$user->name = 'ysj_test_0157';
}

/**
 *面向对象的编程的基本原则
 *1.单一原则:一个类，只需要做好一个事情，
 *2. 开放封闭原则:一个类，应该是可以拓展的。而不可修改的(对扩展是开放的,对修改是封闭的。不应该使用修改来增加功能,而是通过扩展增加功能)
 *3. 依赖倒置:一个类,不应该强依赖另外一个类.每个类对于另外一个类都是可替代的（如果A类依赖B类，不应该直接调用B类，应该通过使用依赖注入方式B把B类注入到A类）
 *4.配置化:尽可能使用配置化，而不是硬编码。
 *5.面向接口编程：只需要关心接口，不需要关心实现。
 */

/**
 * 1.php中使用ArrayAccess实现配置文件的加载
 * 2.在工厂方法中读取配置,生成可配置化的对象
 * 3.使用装饰器模式实现权限验证，模板渲染，json串化
 * 4.使用观察者模式实现数据更新事件的一系列更新操作
 * 5.使用代理模式实现数据库的主从自动切换
 */
/**
 * 自动加载配置
 * [$config description]
 * @var [type]
 */
$config =new \IMooc\Config(__DIR__.'/Config');
var_dump('自动加载配置:');
var_dump($config['controller']);

/**
 * 在工厂方法中读取配置，生成可配置化的对象
 * 从配置文件中生成数据库连接
 */
$db =IMooc\Factory::getDatabase('master');

