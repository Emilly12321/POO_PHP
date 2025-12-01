<?php

/*Importando as Classes para que seja possivel utiliza-las */
require_once '..\Models\Operacao.php';
require_once '..\Models\Soma.php';
require_once '..\Models\Subtrair.php';
require_once '..\Models\Multiplicar.php';
require_once '..\Models\Dividir.php';
require_once '..\Models\TrataeMostra.php';



/* Código de controle */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $valor1 = $_POST['valor1'] ?? " ";
    $valor2 = $_POST['valor2'] ?? " ";
    $operacao = $_POST['operacao'] ?? " ";

    $vlr1 = TrataeMostra::convertendoValor($valor1);
    $vlr2 = TrataeMostra::convertendoValor($valor2);

    $result = null;
    $error = null;
    $tipoCalculo = null;


    if ($vlr1 === null || $vlr2 === null) {
        $error = 'Entrada inválida. Favor preencher corretamente os campos.';
    } else {
        switch ($operacao) {
            case 'somar':

                $tipoCalculo = new Soma();
                
                break;
                case 'subtrair':
                    
                    $tipoCalculo = new Subtrair();
                    
                    break;
                    
                    case 'multiplicar':
                        
                        $tipoCalculo = new Multiplicar();
                        
                        
                        break;
                        
                        case 'dividir':
                            
                            if ($vlr2 === 0.0) 
                            {
                                
                                $error = "Divisão por 0 é inválido, favor informe outro valor";
                            } 
                            else 
                            {
                                
                                $tipoCalculo = new Dividir();
                                
                            }
                            break;

                            
                        }
                            if(empty($error)){

                                $tipoCalculo->setNum1($vlr1);
                                $tipoCalculo->setNum2($vlr2);
                                $result = $tipoCalculo->calcula();
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

    <title>Calculadora_POOV6</title>
</head>

<body>
    <main class="container">

        <?php

        
            TrataeMostra::exibirResultado($error,$operacao,$vlr1,$vlr2,$result);

        ?>

    </main>


</body>

</html>