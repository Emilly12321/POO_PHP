<?php


// Programação estruturada: cada operação é implementada em função separada.
function somar($a, $b)
{
    return $a + $b;
}


function subtrair($a, $b)
{
    return $a - $b;
}

function multiplicar($a, $b)
{
    return $a * $b;
}

function dividir($a, $b)
{
    if ($b == 0) {
        return null;
    }
    return $a / $b;
}

//Função utilitaria que limpa/normaliza a entrada
function convertendoValor($v)
{

    $valor = trim($v);

    $valor = str_replace(',', '.', $valor);

    if (!preg_match('/^\s*[+-]?\d+(?:[\.,]\d+)?\s*$/', $valor)) {
        return null;
    }

    return floatval($valor);
}




if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $valor1 = $_POST['valor1'] ?? '';
    $valor2 = $_POST['valor2'] ?? '';
    $operacao = $_POST['operacao'] ?? '';


    $valor1 = convertendoValor($valor1);
    // echo "<br>";
    $valor2 = convertendoValor($valor2);

    $result = null;
    $error = null;


    if ($valor1 === null || $valor2 === null) {
        $error = 'Entrada inválida. Favor preencher corretamente os campos.';
    } else {
        switch ($operacao) {
            case 'somar':
                $result = somar($valor1, $valor2);
                break;
            case 'subtrair':
                $result = subtrair($valor1, $valor2);
                break;
            case 'multiplicar':
                $result = multiplicar($valor1, $valor2);
                break;
            case 'dividir':

                if ($valor2 == 0) {
                    $error = 'Divisão por 0 é inválido, favor informe outro valor';
                } else {
                    $result = dividir($valor1, $valor2);
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
        <h1>Resultado</h1>

        <?php

        if ($error !== null) {

            // função htmlspecialchar pode receber até três paremetros, sendo o primeiro nossa string, após isso o parametro que irá lidar com aspas ou apóstrofos, e o ultimo é referente ao charset
            echo "<p class='error'>" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "</p>";
        } else {
            echo "<p>Operação:<strong>" . htmlspecialchars($operacao) . "</strong></p>";
            echo "<p>" . htmlspecialchars($valor1);

            switch ($operacao) {
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

            echo htmlspecialchars($valor2) . "= <strong>" . htmlspecialchars($result) . "</strong></p>";
        }

        ?>

        <p><a href="index.html">Voltar</a></p>




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