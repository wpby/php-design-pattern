<?php

namespace IMooc\Database;

use IMooc\IDatabase;

class Mysqli implements IDatabase
{
	protected $connect;
	function connect($host, $user, $password, $db_name)
	{
		$connect = mysqli_connect($host, $user, $password, $db_name);
		// if($connect){
		// 	die('连接数据库失败'.mysqli_error());
		// }
		//将连接资源保存起来
		$this->connect = $connect;
	}

	function query($sql)
	{
		mysqli_query($this->connect, $sql);
	}
	
	function close()
	{
		mysqli_close($this->connect);
	}
}