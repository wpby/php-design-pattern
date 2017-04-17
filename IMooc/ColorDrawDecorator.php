<?php

namespace IMooc;

/**
 * 装饰器模式
 * 必须实现装饰器的接口
 * 颜色装饰器
 */
class ColorDrawDecorator implements DrawDecorator
{
	protected $color;

	/**
	 * 构造方法
	 */
	function __construct($color = "red")
	{
		$this->color = $color;
	}

	function beforeDraw()
	{
		echo "<div style='color:{$this->color}'>";
	}

	function afterDraw()
	{
		echo "</div>";
	}
}