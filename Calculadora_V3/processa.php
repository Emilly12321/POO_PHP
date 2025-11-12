<?php

/*Importando as Classes */
require_once 'Classes\Calculadora.php';
require_once 'Classes\TrataeMostra.php';


/* Código de controle */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $valor1 = $_POST['valor1'] ?? " ";
    $valor2 = $_POST['valor2'] ?? " ";
    $operacao = $_POST['operacao'] ?? " ";

    $vlr1 = TrataeMostra::convertendoValor($valor1);
    $vlr2 = TrataeMostra::convertendoValor($valor2);

    $result = null;
    $error = null;

    /* Criando um objeto a partir da Classe Calculadora */
    $calculadoraObjeto = new Calculadora();


    if ($vlr1 === null || $vlr2 === null) {
        $error = 'Entrada inválida. Favor preencher corretamente os campos.';
    } else {
        switch ($operacao) {
            case 'somar':
                $result = $calculadoraObjeto->somar($vlr1, $vlr2);
                break;
            case 'subtrair':
                $result = $calculadoraObjeto->subtrair($vlr1, $vlr2);
                break;
            case 'multiplicar':
                $result = $calculadoraObjeto->multiplicar($vlr1, $vlr2);
                break;
            case 'dividir':

                if ($vlr2 == 0) {
                    $error = 'Divisão por 0 é inválido, favor informe outro valor';
                } else {
                    $result = $calculadoraObjeto->dividir($vlr1, $vlr2);
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

    <title>Calculadora_POOV2</title>
</head>

<body>
    <main class="container">

        <?php

        
            TrataeMostra::exibirResultado($error,$operacao,$vlr1,$vlr2,$result);

        ?>






    </main>


</body>

</html>



