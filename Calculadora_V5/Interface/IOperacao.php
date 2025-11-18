<?php 

interface IOperacao
{

    public function setNum1(float $numero1):void;
    public function setNum2(float $numero2):void;
    public function calcula():float;
    
}

?>