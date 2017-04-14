<?php

namespace IMooc;

//链式方法，每个方法一定要return $this
class Database
{
	//单例模式
	//3私一公 私有构造函数，私有静态成员变量，私有克隆函数 一个公共静态方法---通常命名为getInstance
	private static $db;

	private function __construct()
	{

	}

	//防止在外部克隆
	private function __clone()
	{

	}
	//获取实例
	static function getInstance()
	{
		if(self::$db){
			return self::$db;
		}else{
			self::$db = new self();
			return self::$db;
		}
	}

	function where($where)
	{
		return $this;
	}

	function order($where)
	{
		return $this;
	}

	function limit($limit)
	{
		return $this;
	}

	function test()
	{
		echo 'database的测试<br>';
	}
}