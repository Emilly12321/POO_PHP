<?php

session_start();

require_once '../Models/Fabrica.php';

if($_SERVER['REQUEST_METHOD']==="POST"){
    $acao = $_POST['acao']??"";


    switch($acao){
        case "fabricar":
            echo'
            <section>
            
            <form action="processa.php" method="POST">
            <input type="hidden" name="acao" value="criandoCarro">
            
            
            <label>Quantidade de carros a serem Fabricados:</label>
            <input type="number" min="1" name="qtdeFabricar">
            <button type="submit">Confirmar</button>
            

            </form>
            
            </section>
            
            
            ';
            echo "
                <a href='..\View\index.html'>Voltar ao menu</a>";
            break;
        case"criandoCarro":
            
            $qtdeFabricar = $_POST['qtdeFabricar']??"";

            echo "
            <section>

            <form action='processa.php' method='POST'>
            <input type='hidden' name='acao' value='salvarCarro'>
            <input type ='hidden' name='qtdeFabricar' value='{$qtdeFabricar}'>";

            for($i = 1 ; $i <= $qtdeFabricar ; $i++){

                echo"<br>
                <label>Modelo:</label>
                <input type='text' name='modelo_{$i}'><br>
                <label>Cor:</label>
                <input type='text' name='cor_{$i}'>
                <br><br>
                ";
            }
                
                echo'<button type="submit">Confirmar</button>
                </form></section>';
                echo "
                <a href='..\View\index.html'>Voltar ao menu</a>";
                
            

            break;
        case "salvarCarro":

            $qtdeFabricar = $_POST['qtdeFabricar']??"";
          
            if(isset($_SESSION['fabrica'])){
               $fabrica = unserialize($_SESSION['fabrica']);
            }else{
                
                $fabrica = new Fabrica();
            }

            $veiculos = [];

            for($i = 1 ;$i <= $qtdeFabricar ; $i++){

                $carro = new Carro();
                $carro->setModelo($_POST["modelo_{$i}"]??"");
                $carro->setCor($_POST["cor_{$i}"]??"");
                $veiculos[] = $carro;
            }
            $fabrica->fabricarCarros($veiculos);

            $_SESSION['fabrica']= serialize($fabrica);

            echo "
            <h3>Sucesso na Fabricação</h3>
            <a href='..\View\index.html'>Voltar ao menu</a>
            ";


        break;
        case "venda":
            echo '
            
            <h1>Informe o Modelo e Cor que deseja vender</h1>
            
            <form action="processa.php" method="POST">
            
            <input type="hidden" name="acao" value="venderCarro">
            
            <label>Modelo: </label>
            <input type="text" name="modelo">
            <label>Cor: </label>
            <input type="text" name="cor">
            <button type="submit">Avançar</button>
            
            </form>';
            echo "
                <a href='..\View\index.html'>Voltar ao menu</a>";
            break;
        case "venderCarro":
          
            if(!isset($_SESSION['fabrica'])){
                echo"<h1>Não há carros fabricados!!</h1>";
                echo "<a href='..\View\index.html'>Voltar ao menu</a>";
                break;
            }

            $modelo = $_POST['modelo'] ?? "";
            $cor = $_POST['cor'] ?? "";

            $fabrica = unserialize($_SESSION['fabrica']);


            $validador = $fabrica->venderCarros($modelo,$cor);

            if($validador){
                
                echo "
                <h3>Carro vendido com sucesso!!</h3>
                <p>Modelo: {$modelo} e Cor: {$cor}</p>";

            }else{
                echo"Não há carros cadastrados com essas informações!!";
            }
            
            $_SESSION['fabrica']= serialize($fabrica);

            echo "<a href='..\View\index.html'>Voltar ao menu</a>";

        break;
        case "info":
            if(!isset($_SESSION['fabrica'])){
                echo"<p>Não há carros cadastrados!</p><br>
                <a href='..\View\index.html'>Voltar ao menu</a>";
                break;
            }
            $fabrica = unserialize($_SESSION['fabrica']);
            echo "Carros fabricados: <br> ";
            $fabrica->mostrarCarros();
            echo"<form action='processa.php' method='POST'>
            
            <input type='hidden'name='acao' value='finalizar_secao'>
            <button>Fechar a Fábrica</button>
            
            </form>";
            echo "<a href='..\View\index.html'>Voltar ao menu</a>";
            break;
        case "finalizar_secao":
            session_destroy();
            echo"<h1>Fábrica Fechada, carros foram destruídos...</h1>";
            echo "<a href='..\View\index.html'>Voltar ao menu</a>";
            break;
        default:
            echo"<h1></";
        break;
    }


}



?>