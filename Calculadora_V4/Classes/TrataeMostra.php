<?php 

final class TrataeMostra{

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


?>