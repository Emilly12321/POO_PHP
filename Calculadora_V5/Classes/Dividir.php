<?php 

final class Dividir implements IOperacao{

    // Criando os atributos direto na classe para nosso objeto Subtrair, e serão usadas pelo mesmo.
    
    private float $numero1;
    private float $numero2;

    // Get --> pegar algo ||| Set --> Setar ou definir("armazenar") um valor a algo



    // Método que permite retornar o valor do $numero1 para quem esteja solicitando, ou seja, o objeto
    public function getNumero1():float
    {
        return $this->numero1;
    }

    // Método que permite que o valor passado pelo objeto seja recebido no nosso atributo.

    public function setNum1(float $numero1):void
    {
        $this->numero1 = $numero1;
    }
    

    // Método que permite retornar o valor do $numero1 para quem esteja solicitando, ou seja, o objeto

    public function getNumero2():float
    {
        return $this->numero2;
    }


    // Método que permite que o valor passado pelo objeto seja recebido no nosso atributo.

    public function setNum2(float $numero2):void
    {
        $this->numero2 = $numero2;
    }
    
    // Método Somar entre os atributos...

    public function calcula():float
    {
        
        return $this->numero1 / $this->numero2;

    }

}



?>