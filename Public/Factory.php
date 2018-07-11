<?php
/**
 * 定义抽象类,让子类去继承实现它*/
abstract class Operation
{
    //抽象方法不能包含函数体
    abstract public function getValue($num1,$num2);
    
    //根据输入的运算符号，工厂就能实例化出合适的对象
    public static function createObj($operate)
    {
        switch($operate)
        {
            case "+":
                return new OperationAdd();
                break;
            case "-":
                return new OperationSub();
                break;
            case "*":
                return new OperationMul();
                break;
            case "/":
                return new OperationDiv();
                break;
        }
    }
}

/**
 * 加法类*/
class OperationAdd extends Operation 
{
    public function getValue($num1,$num2)
    {
        return $num1 + $num2;
    }
}

/**
 * 减法类*/
class OperationSub extends Operation
{
    public function getValue($num1, $num2)
    {
        return $num1 - $num2;
    }
}

/**
 * 乘法类*/
class OperationMul extends Operation
{
    public function getValue($num1, $num2)
    {
        return $num1 * $num2;
    }
}

/**
 * 除法类*/
class OperationDiv extends Operation
{
    public function getValue($num1, $num2){
        try 
        {
            if ($num2==0)
            {
                throw new Exception("除数不能为0");
            } 
            else 
            {
                return $num1/$num2;
            }
        }
        catch (Exception $e)
        {
            echo "错误信息：".$e->getMessage();
        }
    }
}

