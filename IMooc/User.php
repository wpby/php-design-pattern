<?php

namespace IMooc;

//数据对象映射模式
class User
{
	protected $db;

	public $id;
	public $name;
	public $email;
	public $password;

	function __construct($id)
	{
		$this->db = new \IMooc\Database\Mysqli();
		$this->db->connect('localhost', 'homestead', 'secret', 'ysj');
		$res = $this->db->query("select * from users where id = $id limit 1");
		$data = $res->fetch_assoc();
		$this->id = $data['id'];
		$this->name = $data['name'];
		$this->email = $data['email'];
		$this->password = $data['password'];
	}

	//数据调用完后,会自动执行析构函数
	function __destruct()
	{
		$this->db->query("update users set name = '{$this->name}', email = '{$this->email}' where id = {$this->id} limit 1");
	}

}