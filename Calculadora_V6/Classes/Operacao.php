<?php 

require_once 'Interface\IOperacao.php';

abstract class Operacao implements IOperacao{

    
    protected float $numero1;
    protected float $numero2;


    public function getNumero1():float
    {
        return $this->numero1;
    }

    public function setNum1(float $numero1):void
    {
        $this->numero1 = $numero1;
    }
    

    public function getNumero2():float
    {
        return $this->numero2;
    }


    public function setNum2(float $numero2):void
    {
        $this->numero2 = $numero2;
    }
    



}



?>