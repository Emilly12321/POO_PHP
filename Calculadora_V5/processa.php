<?php

/*Importando as Classes para que seja possivel utiliza-las */
require_once 'Interface\IOperacao.php';
require_once 'Classes\Soma.php';
require_once 'Classes\Subtrair.php';
require_once 'Classes\Multiplicar.php';
require_once 'Classes\Dividir.php';
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



    if ($vlr1 === null || $vlr2 === null) {
        $error = 'Entrada inválida. Favor preencher corretamente os campos.';
    } else {
        switch ($operacao) {

            case 'somar':

                $somaObjeto = new Soma();
                $somaObjeto->setNum1($vlr1);
                $somaObjeto->setNum2($vlr2);
                $result = $somaObjeto->calcula();

                break;
            case 'subtrair':

                $subtrairObjeto = new Subtrair();
                $subtrairObjeto->setNum1($vlr1);
                $subtrairObjeto->setNum2($vlr2);
                $result = $subtrairObjeto->calcula();

                break;

            case 'multiplicar':

                $multiplicarObjeto = new Multiplicar();
                $multiplicarObjeto->setNum1($vlr1);
                $multiplicarObjeto->setNum2($vlr2);
                $result = $multiplicarObjeto->calcula();

                break;

            case 'dividir':

                if ($vlr2 == 0) 
                {

                    $error = 'Divisão por 0 é inválido, favor informe outro valor';

                } 
                else 
                {

                    $dividirObjeto = new Dividir();
                    $dividirObjeto->setNum1($vlr1);
                    $dividirObjeto->setNum2($vlr2);
                    $result = $dividirObjeto->calcula();

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



