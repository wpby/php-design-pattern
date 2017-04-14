<?php

namespace Imooc;

class Object
{
	protected $array = []; //受保护的，只有本类或子类或父类中可以访问；
	//private表示私有的，只有本类内部可以使用
	//public 表示全局，类内部外部子类都可以访问；

	//根据静态的定义，只能被类而不是对象调用 IMooc\Object::index()
	static function index()
	{
		echo 'Imooc下面的静态方法<br>';		
	}

	//当一个对象不存在属性进行赋值时候，会先调用set方法
	function __set($key, $value)
	{
		var_dump(__METHOD__);
		$this->array[$key] = $value;
	}

	//当读取一个对象不存在属性的值得时候，会调用get方法
	function __get($key)
	{
		var_dump(__METHOD__);
		return $this->array[$key];
	}

	//当调用一个对象不存在方法的时候，自动调用。
	function __call($func, $param)
	{
		var_dump($func, $param);
		return "magic function\n";
	}

	//当调用一个对象存在的静态方法的时候, 自动调用
	static function __callStatic($func, $param)
	{
		var_dump($func, $param);
		return 'maginc static function\n';
	}

	//类中没有定义__tostring()方法，则直接输出对象的引用时就会产生误法错误
	function __toString()
	{
		return __CLASS__;
	}

	//把一个对象当场一个函数去自动执行, invoke实际用途：把方法参数化
	function __invoke($param)
	{
		var_dump($param);
		return 'invoke方法';
	}
}