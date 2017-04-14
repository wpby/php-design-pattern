<?php

namespace IMooc;

//注册树模式，将对象实例注册到一棵全局的对象树上。
class Register 
{
	private static $object;

	//将一个对象注册到全局树上，第一个参数是别名，第二个参数是对象
	static function set($alias, $object)
	{
		var_dump(__METHOD__);
		self::$object[$alias] = $object;
	}

	//获取一个对象,取对象时候需要先注册到注册树上面
	static function get($alias)
	{
		var_dump(__METHOD__);
		return self::$object[$alias];
	}

	//set是关键词，所以加一个下划线
	function _unset()
	{
		unset(self::$object[$alias]);
	}
}