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

	static function getDatabase($id = 'proxy')
    {
        if ($id == 'proxy')
        {
            if (!self::$proxy)
            {
                self::$proxy = new \IMooc\Database\Proxy;
            }
            return self::$proxy;
        }
  
        $key = 'database_'.$id;
        if ($id == 'slave')
        {
            $slaves = Application::getInstance()->config['database']['slave'];
            $db_conf = $slaves[array_rand($slaves)];
        }
        else
        {//这里单例出来的只是配置信息
            $db_conf = Application::getInstance()->config['database'][$id];
        }
        $db = Register::get($key);
        if (!$db) {
            $db = new Database\MySQLi();
           //根据配置信息实例$db,并储存到注册器数组中
            $db->connect($db_conf['host'], $db_conf['user'], $db_conf['password'], $db_conf['dbname']);
            Register::set($key, $db);
        }
        return $db;
    }
}