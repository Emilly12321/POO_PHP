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
            <input type="hidden" name="acao" value="salvarCarro">
            
            <label>Modelo:</label>
            <input type="text" name="modelo">
            <label>Cor:</label>
            <input type="text" name="cor">
            <label>Quantidade a ser Fabricada:</label>
            <input type="number" min="1" name="qtdeFabricar">
            <button type="submit">Confirmar</button>
            

            </form>
            
            </section>
            
            
            ';
            break;
        case "salvarCarro":
            $modelo = $_POST['modelo'] ?? "";
            $cor = $_POST['cor'] ?? "";
            $qtdeFabricar = $_POST['qtdeFabricar']??"";
          
            if(isset($_SESSION['fabrica'])){
               $fabrica = unserialize($_SESSION['fabrica']);
            }else{
                $fabrica = new Fabrica();
            }

            $fabrica->fabricarCarros($modelo,$cor,$qtdeFabricar);

            $_SESSION['fabrica'] = serialize($fabrica);

            echo "
            <form>
            
            <label>Modelo: {$modelo}</label>
            <label>Cor: {$cor}</label>
            <label>Quantidade que foram cadastrados: {$qtdeFabricar}</label>
            </form>
            <a href='..\View\index.html'>Voltar ao menu</a>
            ";


        break;
        case "info":
            if(!isset($_SESSION['fabrica'])){
                echo"<p>Não há carros cadastrados!</p>";
            }
            $fabrica = unserialize($_SESSION['fabrica']);
            echo "Carros fabricados: <br> ";
            $fabrica->mostrarCarros();
            break;
    }


}



?>