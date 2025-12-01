<?php 

interface IOperacao
{

    public function setNum1(float $numero1):void;
    public function setNum2(float $numero2):void;
    public function calcula():float;
    
}




abstract class Animal {

    public function som():void{
        echo "Som aleátorio de Animal";
    }

}

final class Ave extends Animal{

    // Modificando para o sentido da classe
     public function som():void{
        echo "Som: Piu Piu";
    }

}

final class Terrestre extends Animal{
    
    // Modificando para o sentido da classe
     public function som():void{
        echo "Som: Au au";
    }

}

?>