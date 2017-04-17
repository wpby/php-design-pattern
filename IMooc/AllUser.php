<?php 

namespace IMooc;

/**
 * 迭代器模式
 * 迭代器的实现需要继承\Iterator
 * 需要5个方法去实现
 * 
 */
class AllUser implements \Iterator
{
	protected $ids = [];
	protected $data = array();
	//迭代器的当前位置
	protected $index;

	public function __construct()
	{
		$db = mysqli_connect('localhost', 'homestead', 'secret', 'ysj');
		//这是一个结果集
		$result = $db->query("select * from users");
		//索引数组
		$this->ids = $result->fetch_all(MYSQLI_ASSOC);
		var_dump($this->ids);
	}

	/**
	 * 当前的元素
	 * 第三步，表示拿到当前的数据
	 * @return [type] [description]
	 */
	public function current()
	{
		var_dump($this->ids);
		$id = $this->ids[$this->index]['id'];
		return Factory::getUser($id);
	}

	//第四步，下一个元素
	//将索引值向下移动
	public function next()
	{
		$this->index++;
	}

	/**
	 * 验证当前是否还有下一个元素
	 * 第二步验证，查询当前是否有元素
	 * @return [type] [description]
	 */
	public function valid()
	{
		return $this->index < count($this->ids);
	}

	/**
	 * 重置整个迭代器，迭代到末尾之后，返回到开头
	 * 首先执行的是这个
	 * @return [type] [description]
	 */
	public function rewind()
	{
		$this->index = 0;
	}

	/**
	 * 表示在迭代器中的位置
	 * 获取当前的索引
	 * @return [type] [description]
	 */
	public function key()
	{
		return $this->index;
	}
}