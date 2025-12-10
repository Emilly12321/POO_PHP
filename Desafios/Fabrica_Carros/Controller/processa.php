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

            $_SESSION['fabrica']= serialize($fabrica);

            echo "
            <form>
            
            <label>Modelo: {$modelo}</label> <br>
            <label>Cor: {$cor}</label> <br>
            <label>Quantidade que foram cadastrados: {$qtdeFabricar}</label><br>
            </form> <br>
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
            break;
        case "venderCarro":
            
            $modelo = $_POST['modelo'] ?? "";
            $cor = $_POST['cor'] ?? "";

            $fabrica = unserialize($_SESSION['fabrica']);


            $validador = $fabrica->venderCarros($modelo,$cor);

            if($validador){
                
                echo "
                <h3>Carros vendidos com sucesso!!</h3>

                <form>
                
                <label>Modelo: {$modelo}</label><br>
                <label>Cor: {$cor}</label>                
                
                </form>";

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
            echo "<a href='..\View\index.html'>Voltar ao menu</a>";
            break;
    }


}



?>