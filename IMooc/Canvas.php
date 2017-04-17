<?php
namespace IMooc;

//画布，原型模式
class Canvas
{
    public $data;
    //保存所有添加过的装饰器
    protected $decorators = array();

    //需要20*10次的循环，消耗比较大。
    function init($width = 20, $height = 10)
    {
        $data = array();
        for($i = 0; $i < $height; $i++)
        {
            for($j = 0; $j < $width; $j++)
            {
                $data[$i][$j] = '*';
            }
        }
        $this->data = $data;
    }

    //装饰器接口
    function addDecorator(DrawDecorator $decorator)
    {
        $this->decorators[] = $decorator;
    }

    function beforeDraw()
    {
        //按照顺序，先进先出
        foreach($this->decorators as $decorator)
        {
            $decorator->beforeDraw();
        }
    }

    function afterDraw()
    {
        // <div style='color'>
        // <div style='style'>
        // </div> 
        // </div>
        // 第一行和第四行匹配，第二行和第三行匹配
        //需要一个数组的反转，后进先出
        //反转是因为before和after都存在的情况下需要一一对应
        $decorators = array_reverse($this->decorators);
        foreach($decorators as $decorator)
        {
            $decorator->afterDraw();
        }
    }

    function draw()
    {
        $this->beforeDraw();
        foreach($this->data as $line)
        {
            foreach($line as $char)
            {
                echo $char;
            }
            echo "<br />\n";
        }
        $this->afterDraw();
    }

    function rect($a1, $a2, $b1, $b2)
    {
        foreach($this->data as $k1 => $line)
        {
            if ($k1 < $a1 or $k1 > $a2) continue;
            foreach($line as $k2 => $char)
            {
                if ($k2 < $b1 or $k2 > $b2) continue;
                $this->data[$k1][$k2] = '&nbsp;';
            }
        }
    }
}