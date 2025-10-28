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

//Funcção utilitaria que limpa/normaliza a entrada
function convertendoValor($v)
{

    $valor = trim($val);

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


    echo $valor1 = convertendoValor($valor1);
    echo "<br>";
    echo $valor2 = convertendoValor($valor2);

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

                if($valor2 == 0){
                    $error = 'Divisão por 0 é inválido, favor informe outro valor';
                }else{
                    $result=dividir($valor1,$valor2);
                }
                break;
                
                default:
                $error = 'Operação inválida';
        }
    }
}







?>







<!-- <!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">

    <title>Calculadora Estruturada</title>
</head>

<body>
    <main>
    



    </main>


</body>

</html> -->