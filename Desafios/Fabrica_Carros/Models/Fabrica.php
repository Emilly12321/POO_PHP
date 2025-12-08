<?php 

require_once 'Carro.php';
class Fabrica{  
    private array $guardarCarros = [];

    public function fabricarCarros(string $modelo, string $cor , int $qtdade){
       
        for($i = 1 ; $i <= $qtdade ; $i++){
            $carro = new Carro();
            $carro->setModelo($modelo);
            $carro->setCor($cor);
            $this->guardarCarros[] = $carro;
        }
    }



    public function mostrarCarros(){

        foreach($this->guardarCarros as $i => $carro){
            echo "<p>".($i+1)."° Carro, Modelo:".$carro->getModelo()." Cor:".$carro->getCor()."</p><br>";
        }

    }
}



?>