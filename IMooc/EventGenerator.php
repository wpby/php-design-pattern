<?php

namespace IMooc;

//观察者模式
//表示一个事件产生者
//表示成一个抽象类，只有继承它的子类才有一些相关的逻辑
//继承一个抽象类的时候，子类必须定义父类中的所有抽象方法,不一定定义公共方法
//抽象类通常具有抽象方法，方法中没有大括号
//例如abstract function test($data); 后面没有{}
//
//抽象类是指不可实例化，只允许子类继承。抽象类中也可以有实际的代码。
abstract class EventGenerator
{
	//设置为私有,因为观察者对于事件发生者是不可见的，
	//不知道哪些人关注了这个事件，只知道这个事件发生
	private $observers = [];
	//增加观察者
	//类型限定语法，传入的$observer参数必须是实现了Observer接口的对象。
	function addObserver(Observer $observer){
		$this->observers[] = $observer;
	}
	//通知这个事件发生了。其他观察者进行一个更新的逻辑
	//琢个通知所有观察者
	function notify(){
		foreach ($this->observers as $observer) {
			$observer->update();
		}
	}
}