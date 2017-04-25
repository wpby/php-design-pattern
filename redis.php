<?php

$redis = new Redis();
$redis->connect('localhost', 6379);

/**
 * string 类型开始， key/value
 * [$res description]
 * @var [type]
 */
$res = $redis->get('ysj');
if(!$res){
	$redis->set('ysj','测试一下');
}
echo '结果是：'.$redis->get('ysj');
//删除指定的键
$redis->delete('test');
$redis->set('test:string_demo', 1);
$string_demo = $redis->get('test:string_demo');
echo '<br>string_demo结果是:'.$string_demo;
//自增长
$res = $redis->incr('test:string_demo', 2);
echo '<br>自增2结果是:'.$res.'<br>';
/**
 * string类型结束
 */

/**
 * list类型。左边是key,右边是value. 其中上面是左，下面是右
 * 一般用于队列，先进先出，左边推入元素，右边推出元素
 * 可以重复
 */
$redis->delete('list1');
//从左推入元素
$list = $redis->lpush('list1', '测试1');
//从右推入元素
$list = $redis->rpush('list1', '测试2');
$list = $redis->rpush('list1', '测试2');
$list = $redis->rpush('list1', '测试3');
// echo '从右边推出结果是:'.$redis->rPop('list1').'<br>';

/**
 * set类型, key/value 左边是key,右边是value
 * 元素必须是唯一的
 */
$redis->sadd('set1', '测试set1');
$redis->sadd('set1', '测试set2');
$redis->sadd('set1', '测试set3');
$redis->sadd('set1', '测试set3');
//scard返回集合key的基数(集合中元素的数量)
var_dump($redis->scard('set1'));
// 查，返回集合的内容
var_dump($redis->smembers('set1'));

/**
 * hash类型，左边是key,右边是value.上面是左，下面是右.
 */
$redis->delete('hash1');
//设置hash值
$redis->hset('hash1', 'test', '我是value');
$redis->hset('hash1', 'name', 'summer');
$redis->hset('hash1', 'age', '26');
//获取hash值
echo $redis->hget('hash1', 'test');
//获取多个hash值
var_dump($redis->hmget('hash1', ['test', 'name']));

/**
 * set sort类型，
 * 可用于排行榜
 */

/**
 * zAdd()第一个参数是key，第二个参数是分数(double类型)，第三个参数是value(string类型)
 * value可以看作学生姓名
 */
$redis->zAdd('set_sort1', '88.88', '小米');
$redis->zAdd('set_sort1', '38.88', '小明');

/**
 * 从低到高进行排序
 * 第一个参数是key,第二个参数是开始位置，第三个参数是结束位置
 */
var_dump($redis->zrange('set_sort1', 0, 1));
/**
 * 列出所有排名
 */
var_dump($redis->zrange('set_sort1', 0, -1));
/**
 * 从高到底
 */
var_dump($redis->zrevrange('set_sort1', 0, 3));