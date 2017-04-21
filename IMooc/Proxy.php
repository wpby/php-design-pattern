<?php

namespace IMooc;

/**
 * 代理模式
 */
class Proxy implements IUserProxy
{
	/**
	 * 从数据库，负责取出数据
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function getUserName($id)
	{
		$user = Factory::getDatabase('slave');
		$user->qeury("select name from users where id = $id limit 1");
	}

	/**
	 * 主数据库，负责写数据
	 * @param [type] $id   [description]
	 * @param [type] $name [description]
	 */
	function setUserName($id, $name)
	{
		$db = Factory::getDatabase('master');
		$user->query("update users set name = $name where id = $id limit 1");
	}
}