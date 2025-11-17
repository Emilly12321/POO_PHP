<?php 

final class Calculadora{


    /* Encapsulando--> utilizar os modificadores (public, private, protected), para exercer um controle de acesso para o que queremos*/
    public function somar(float $a, float $b) : float
    {
        return $a + $b;
    }


    public function subtrair(float $a, float $b) : float
    {
        return $a - $b;
    }

    public function multiplicar(float $a, float $b) : float
    {
        return $a * $b;
    }

    public function dividir(float $a, float $b) : float
    {
        if ($b === 0.0){

            return "Erro: divisão por zero";
        }
        return $a / $b;
    }
}


?>