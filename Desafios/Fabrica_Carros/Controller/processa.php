<?php

session_start();

require_once '../Models/Fabrica.php';
require_once '../Models/Carro.php';
require_once '../Models/Motos.php';

if($_SERVER['REQUEST_METHOD']==="POST"){
    $acao = $_POST['acao']??"";


    switch($acao){
        case "fabricar":
            echo'
            <section>
            
            <form action="processa.php" method="POST">
            <input type="hidden" name="acao" value="criandoVeiculo">
            
            
            <label>Quantidade de veiculos a serem Fabricados:</label>
            <input type="number" min="1" name="qtdeFabricar"><br><br>
            <label>Escolha um veiculo para ser fabricado:</label>
            <select name="tipo_veiculo">
                <option value="Motos">Moto</option>
                <option value="Carro">Carro</option>

            </select><br><br>       
            <button type="submit">Confirmar</button>
            

            </form>
            
            </section>
            
            
            ';
            echo "
                <a href='..\View\index.html'>Voltar ao menu</a>";
            break;
        case"criandoVeiculo":
            
            $qtdeFabricar = $_POST['qtdeFabricar']??"";
            $tipo = $_POST['tipo_veiculo'] ?? "";

            echo "
            <section>
            <h1>Fabricando $tipo</h1>
            <form action='processa.php' method='POST'>
            <input type='hidden' name='acao' value='salvarVeiculo'>
            <input type ='hidden' name='qtdeFabricar' value='{$qtdeFabricar}'>
            <input type ='hidden' name='tipo_veiculo' value='{$tipo}'>
            
            
            ";

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
        case "salvarVeiculo":

            $qtdeFabricar = $_POST['qtdeFabricar']??"";
            $tipo = $_POST['tipo_veiculo'] ?? "";
          
            if(isset($_SESSION['fabrica'])){
               $fabrica = unserialize($_SESSION['fabrica']);
            }else{
                
                $fabrica = new Fabrica();
            }

            $veiculos = [];

            for($i = 1 ;$i <= $qtdeFabricar ; $i++){
                if($tipo == "Motos"){
                    $veiculo = new Motos();
                }else{
                    $veiculo = new Carro();

                }
                $veiculo->setModelo($_POST["modelo_{$i}"]??"");
                $veiculo->setCor($_POST["cor_{$i}"]??"");
                $veiculos[] = $veiculo;
            }
            $fabrica->fabricarVeiculos($veiculos);

            $_SESSION['fabrica']= serialize($fabrica);

            echo "
            <h3>Sucesso na Fabricação</h3>
            <a href='..\View\index.html'>Voltar ao menu</a>
            ";


        break;
        case "venda":
            if(!isset($_SESSION['fabrica'])){
            echo"<h1>Não há veiculos para venda!!</h1>";
            echo "<a href='..\View\index.html'>Voltar ao menu</a>";
            break;
            }

            echo '
            <h1>Informe Qual veiculo que deseja vender </h1>
            
            <form action="processa.php" method="POST">
            
            <input type="hidden" name="acao" value="venda">

            <button name="acaoDois" value="Motos">Motos</button>
            <button name="acaoDois" value="Carro">Carro</button>

            </form>';
         
            $acaoDois = $_POST['acaoDois']  ?? "";
            $fabrica = unserialize($_SESSION['fabrica']);

            switch($acaoDois){
                

                case 'Motos':
                        $fabrica->mostrarTipoVeiculos($acaoDois);
                        echo ' <form action="processa.php" method="POST">
                        <input type="hidden" name="tipo_veiculo" value="Motos">
                        <input type="hidden" name="acao" value="venderCarro">
                        <label>Modelo: </label>
                        <input type="text" name="modelo">
                        <label>Cor: </label>
                        <input type="text" name="cor"><br>
                        <button type="submit">Enviar</button>
                        </form>';

            

                break;

                case 'Carro':
                    $fabrica->mostrarTipoVeiculos($acaoDois);         

                    echo ' 
                    <form action="processa.php" method="POST">
                    <input type="hidden" name="tipo_veiculo" value="Carro">
                    <input type="hidden" name="acao" value="venderCarro">
                    <label>Modelo: </label>
                    <input type="text" name="modelo">
                    <label>Cor: </label>
                    <input type="text" name="cor"><br>
                    <button type="submit">Enviar</button>
                    
                    </form>';
                         
                        
                    break;
            
                    
                    
                }
                
              $_SESSION['fabrica']= serialize($fabrica);
              echo "<a href='..\View\index.html'>Voltar ao menu</a>";

            break;
        case "venderCarro":
          
           

            $modelo = $_POST['modelo'] ?? "";
            $cor = $_POST['cor'] ?? "";
            $tipo = $_POST['tipo_veiculo']?? "";

            $fabrica = unserialize($_SESSION['fabrica']);


            $validador = $fabrica->venderVeiculos($modelo,$cor);

            if($validador){
                
                echo "
                <h3> Efetuado a Venda: ".$tipo."!!</h3>
                <p>Modelo: {$modelo} e Cor: {$cor}</p>";

            }else{
                echo"Não há  veiculos com essas informações!!";
            }
            
            $_SESSION['fabrica']= serialize($fabrica);

            echo "<a href='..\View\index.html'>Voltar ao menu</a>";

        break;
        case "info":
            if(!isset($_SESSION['fabrica'])){
                echo"<p>Não há veiculos cadastrados!</p><br>
                <a href='..\View\index.html'>Voltar ao menu</a>";
                break;
            }
            
            $fabrica = unserialize($_SESSION['fabrica']);
            echo "Veiculos fabricados: <br> ";

            echo '
            <form action="processa.php" method="POST">
            
            <input type="hidden" name="acao" value="info">

            <button name="acaoInfo" value="Motos">Motos</button>
            <button name="acaoInfo" value="Carro">Carro</button>
            <button name="acaoInfo" value="infoGeral">Em estoque</button>
            
            </form>
            
            ';
            $acaoInfo = $_POST['acaoInfo']??"";
            
            switch($acaoInfo){
                
                case'Motos':
                $fabrica->mostrarTipoVeiculos($acaoInfo);
                break;
                
                case'Carro':
                $fabrica->mostrarTipoVeiculos($acaoInfo);
                break;
                
                case'infoGeral':
                $fabrica->mostrarVeiculos();
                break;

            }

            echo"<form action='processa.php' method='POST'>
            
            <input type='hidden'name='acao' value='finalizar_secao'>
            <button>Fechar a Fábrica</button>
            
            </form>";
            echo "<a href='..\View\index.html'>Voltar ao menu</a>";
            break;
        case "finalizar_secao":
            session_destroy();
            echo"<h1>Fábrica Fechada, veiculos foram destruídos...</h1>";
            echo "<a href='..\View\index.html'>Voltar ao menu</a>";
            break;
        default:
            echo"<h1></h1>";
        break;
    }


}



?>