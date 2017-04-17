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

	/**
	 * param [integer] $id
	 * //定义一个新得工厂静态方法
	 */
	static function getUser($id)
	{
		//注册器模式
		//设置key,user的id不同，代表不同的user
		$key = 'user_'.$id;
		$user = Register::get($key);
		if(!$user){
			//数据对象映射模式,不方便需要改成注册器模式
			$user = new User($id);
			//如果注册器中没有注册这个对象。则需要注册一下
			Register::set($key, $user);
		}
		
		return $user;
	}
}