<?php

namespace IMooc\Database;

use IMooc\IDatabase;

class Mysql implements IDatabase
{
	protected $conn;
	public function  connect($host, $user, $password, $data_name)
	{
		$conn = mysql_connect($host, $user, $password);
		if(!$con){
			die('Could no connect'.msyql_eeror());
		}
		mysql_select_db($data_name, $conn);
		mysql_set_charset('UTF-8');
		$this->conn = $conn;
	}

	public function query($sql)
	{
		mysql_query($sql, $this->conn);
	}

	public function close()
	{
		mysql_close($this->conn);
	}
}