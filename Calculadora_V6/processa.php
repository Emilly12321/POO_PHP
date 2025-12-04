<?php

/*Importando as Classes para que seja possivel utiliza-las */
require_once 'Classes\Operacao.php';
require_once 'Classes\Soma.php';
require_once 'Classes\Subtrair.php';
require_once 'Classes\Multiplicar.php';
require_once 'Classes\Dividir.php';


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


