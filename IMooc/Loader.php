<?php

namespace IMooc;

class Loader
{
	static function autoload($class)
	{
		// var_dump($class);
		require BASEDIR.'/'.str_replace("\\", '/', $class).'.php';
		$file = BASEDIR.'/'.str_replace("\\", '/', $class).'.php';
		var_dump($file);
	}
}