<?php

namespace IMooc;

//接口
//观察者模式

interface Observer
{
	//表示事件发生了,要进行update操作
	function update($event_info = null);
}