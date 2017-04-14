<?php
namespace IMooc;

//工厂模式
class Factory
{
	//静态方法
	static function createDatabase()
	{
		//单例模式
		// return Database::getInstance();
		$db = Database::getInstance();
		//注册到注册树上面
		Register::set('db1', $db);
		return $db;
	}

	static function test($param)
	{
		return $param;
	}
}