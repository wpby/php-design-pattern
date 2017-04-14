<?php

namespace IMooc;

interface IDatabase
{
	public function connect($host, $user, $password, $db_name);

	public function query($mysql);

	public function close();
}