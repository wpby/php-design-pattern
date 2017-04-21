<?php
namespace IMooc;

/**
 * 自动加载配置文件
 * 使用ArrayAccess可以把一个对象，变成使用数组的访问方式
 */
class Config implements \ArrayAccess
{
	protected $path;
	protected $config = array();

	public function __construct($path)
	{
		$this->path = $path;
	}

	public function offsetGet($key)
	{
		if(empty($this->configs[$key])){
			//从文件中加载配置
			$file_path = $this->path.'/'.$key.'.php';
			$config = require $file_path;
			$this->config[$key] = $config;
		}
		return $this->config[$key];
	}

	public function offsetSet($key, $value)
	{
		throw new \Exception('cannot wirte config file');
	}

	public function offSetExists($key)
	{
		return isset($this->config[$key]);
	}

	public function offsetUnset($key)
	{

	}
}