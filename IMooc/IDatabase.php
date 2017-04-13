<?php

namespace IMooc;

interface IDatabase
{
	public function connect($ip, $user, $password, $da_name);
	public function query($mysql);
	public function close();
}