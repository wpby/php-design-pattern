<?php

namespace IMooc\Database;

use IMooc\IDatabase;

//pdo是通用的连接数据库，比如说oracle
class PDO implements IDatabase
{
	protected $connect;
	function connect($host, $user, $password, $db_name)
	{
		//new 一个根目录的PDO
		$connect = new \PDO("mysqli:$host=$host;dbname=$dbname", $user, $password);
		//将连接资源保存起来
		$this->connect = $connect;
	}

	function query($sql)
	{
		return $this->connect->query($sql);
	}
	
	function close()
	{
		unset($this->connect);
	}
}