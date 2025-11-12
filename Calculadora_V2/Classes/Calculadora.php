<?php 

final class Calculadora{

    public static function somar(float $a, float $b) : float
    {
        return $a + $b;
    }


    public static function subtrair(float $a, float $b) : float
    {
        return $a - $b;
    }

    public static function multiplicar(float $a, float $b) : float
    {
        return $a * $b;
    }

    public static function dividir(float $a, float $b) : float
    {
        if ($b === 0.0){

            return "Erro: divisão por zero";
        }
        return $a / $b;
    }
}


?>