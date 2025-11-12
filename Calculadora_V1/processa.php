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


    public static function exibirResultado(?string $er, string $oper, ?float $valor1 ,  ?float $valor2 , ?float $resultado): void
    {

        echo "<h1>Resultado</h1>";

        if(!empty($er)){

            echo '<p class="error">'.htmlspecialchars($er,ENT_QUOTES,'UTF-8').'</p>';

        }else{

            echo '<p>Operação: <strong>'.htmlspecialchars($oper,ENT_QUOTES,'UTF-8').'</strong></p>';
            echo '<p>'.htmlspecialchars($valor1,ENT_QUOTES,'UTF-8').' ';

            switch($oper){
                case 'somar':
                    echo '+';
                break;
                case 'subtrair':
                    echo '-';
                break;
                case 'multiplicar':
                    echo 'x';
                break;
                case 'dividir':
                    echo '/';
                break;
            }
            echo ' '. htmlspecialchars($valor2,ENT_QUOTES,'UTF-8');
            echo '= <strong>'.htmlspecialchars($resultado,ENT_QUOTES,'UTF-8').'</strong></p>';

        }
        echo '<p><a href="index.html">Voltar</a></p>';

    }

    public static function convertendoValor($v): ?float
    {

        $valor = trim($v);

        $valor = str_replace(',', '.', $valor);

        if (!preg_match('/^\s*[+-]?\d+(?:[\.,]\d+)?\s*$/',$valor)) {
            return null;
        }

        return floatval($valor);
    }


}



/* Código de controle */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $valor1 = $_POST['valor1'] ?? " ";
    $valor2 = $_POST['valor2'] ?? " ";
    $operacao = $_POST['operacao'] ?? " ";

    $vlr1 = Calculadora::convertendoValor($valor1);
    $vlr2 = Calculadora::convertendoValor($valor2);

    $result = null;
    $error = null;

    if ($vlr1 === null || $vlr2 === null) {
        $error = 'Entrada inválida. Favor preencher corretamente os campos.';
    } else {
        switch ($operacao) {
            case 'somar':
                /* Indo na Classe Calculadora e acessando o método estatico chamado somar e enviando os parametros para ela */
                $result = Calculadora::somar($vlr1, $vlr2);
                break;
            case 'subtrair':
                $result = Calculadora::subtrair($vlr1, $vlr2);
                break;
            case 'multiplicar':
                $result = Calculadora::multiplicar($vlr1, $vlr2);
                break;
            case 'dividir':

                if ($vlr2 == 0) {
                    $error = 'Divisão por 0 é inválido, favor informe outro valor';
                } else {
                    $result = Calculadora::dividir($vlr1, $vlr2);
                }
                break;

            default:
                $error = 'Operação inválida';
        }
    }

}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">

    <title>Calculadora Estruturada</title>
</head>

<body>
    <main class="container">

        <?php

        
        Calculadora::exibirResultado($error,$operacao,$vlr1,$vlr2,$result);

        ?>






    </main>


</body>

</html>



<!-- Efetuando no formato do passo a passo do documento
             
            
            
            
            <php if(error !== null): ?>
                <p class="error"><php echo htmlspecialchar($error,ENT_QUOTES,'UTF-8');?></p>
            <php else: ?>
                <p>Operação: <strong> <php echo htmlspecialchar($operacao); ?></strong></p> 
                <p><php echo htmlspecialchar($valor1); ?> 
                    <php 

                        switch($operacao){

                            case 'somar': echo '+';break;
                            case 'subtrair': echo '-';break;
                            case 'multiplicar': echo '*';break;
                            case 'dividir': echo '/';break;
                        
                        }
                        
                    ?>  

                    <php echo htmlspecialchar($valor2)?> =
                    <strong <php echo htmlspecialchar($result)?> </strong> </p>
            
            <php endif; ?>
            
            <p><a href="index.html">Voltar</a></p>
            -->