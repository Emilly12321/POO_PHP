<?php 

session_start();

require_once 'Models/Casa.php';
require_once 'Models/Porta.php';
require_once 'Models/Janela.php';



if($_SERVER['REQUEST_METHOD' === 'POST']){
    $acao = $_POST['acao']?? '';

    switch($acao){
        case 'construir':
            echo"<h2>Você escolheu construir a casa!</h2>";
            echo"<p>Preencha os dados abaixo para definir as características da sua casa: </p>";

            echo '

            <form action="processa.php" method="POST">
                <input type="hidden" name="acao" value"salvar_casa">

                <label><strong>Descrição da casa</strong></label>
                <br>
                <input type="text" name="descricao" required><br><br>

                <label><strong>Cor da casa</strong></label><br>
                <input type="text" name="cor" required> <br><br>


                <label><strong>Quantidade de portas:</strong></label><br>
                <input type="number" name="qtde_portas" min="0" required> <br><br>

                <label><strong>Quantidade de Janelas</strong></label><br>
                <input type="number" name="qtde_janelas" min="0" required> <br><br>

                <button type="submit">Avançar</button>
            
            </form>';
            break;

            case 'salvar_casa':
                $descricao = $_POST['descricao'] ?? '';
                $cor = $_POST['cor'] ?? '';
                $qtde_Portas = (int)($_POST['qtde_portas'] ?? 0);
                $qtde_Janelas = (int)($_POST['qtde_janelas'] ?? 0);
                
                echo "<h2>Etapa 2 : Definir portas e janelas</h2>";
                echo '<form action="processa.php" method="POST">';
                
                echo '<input type ="hidden" name="acao" value="finalizar_casa">';
                echo "<input type ='hidden' name='descricao' value='{$descricao}'>";
                echo "<input type ='hidden' name='cor' value='{$cor}'>";
                echo "<input type ='hidden' name='qtde_portas' value='{$qtde_Portas}'>";
                echo "<input type ='hidden' name='qtde_janelas' value='{$qtde_Janelas}'>";
                
                if($qtde_Portas>0){
                    echo "<h3>Janelas</h3>";
                    for($i = 1; $i <= $qtdePortas;$i++){
                        echo "<label>Descrição da Porta {$i}:</label><br>";
                        echo "<input type='text' name='descricao_porta_{$i}' required><br>";
                        echo "<label>Estado:</label>";
                        echo "<selct name='estado_porta_{$i}'>
                        <option value='0'>Fechada</option>
                        <option value='1'>Aberta</option>
                        </select> <br><br>";
                    }
                }

                if($qtde_Janelas>0){
                    echo "<h3>Janelas</h3>";
                    for($i = 1; $i <= $qtdeJanelas;$i++){
                        echo "<label>Descrição da Janela {$i}:</label><br>";
                        echo "<input type='text' name='descricao_janela_{$i}' required><br>";
                        echo "<label>Estado:</label>";
                        echo "<selct name='estado_janela_{$i}'>
                        <option value='0'>Fechada</option>
                        <option value='1'>Aberta</option>
                        </select> <br><br>";
                    }
                }

                echo "<button type='submit'>Finalizar Construção</button>";
                echo '</form>';
                break;
                
                case 'finalizar_casa':
                    $descricao = $_POST['descricao']??'';
                    $cor = $_POST['cor'] ?? '';
                    $qtde_Portas = (int) ($_POST['qtde_portas']??0);
                    $qtde_Janelas = (int) ($_POST['qtde_janelas']??0);
                    
                    $casa = new Casa();
                    $casa->setDescricao($descricao);
                    $casa->setCor($cor);

                    $listaPortas = [] ;

                    for($i = 1 ; $i <= $qtdePortas;$i++){
                        $porta = new Porta();
                        $porta->setDescricao($_POST["descricao_porta_{$i}"]);
                        $porta->setEstado((int)$_POST["estado_porta_{$i}"]);
                        $listaPortas[] = $portas;
                    }
                    $casa->setListaDePortas($listaPortas);
            
                }
}



?>