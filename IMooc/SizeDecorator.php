<?php

namespace IMooc;

/**
 * 装饰器模式
 * 修改文字的大小
 */
class SizeDecorator implements DrawDecorator
{
	protected $size;

	public function __construct($size = '16px')
	{
		$this->size = $size;
	}

	public function beforeDraw()
	{
		echo "<div style='font-size:{$this->size}'>";
	}

	public function afterDraw()
	{
		echo "</div>";
	}
}