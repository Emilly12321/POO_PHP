<?php 

require_once 'Carro.php';
class Fabrica{  
    private array $guardarCarros = [];

    public function fabricarCarros(string $modelo, string $cor , int $qtdade):void{
       
        for($i = 1 ; $i <= $qtdade ; $i++){
            $carro = new Carro();
            $carro->setModelo($modelo);
            $carro->setCor($cor);
            $this->guardarCarros[] = $carro;
        }
    }

    public function venderCarros(string $modelo, string $cor){

        print_r($this->guardarCarros);

    
        foreach($this->guardarCarros as $i => $guardarCarros){

            if( $guardarCarros->getModelo() === $modelo &&  $guardarCarros->getCor() === $cor){

                unset($this->guardarCarros[$i]);
              
                $this->guardarCarros = array_values($this->guardarCarros);
               
                return true;
                
            }

        }
        return false;

    }



    public function mostrarCarros(){

        foreach($this->guardarCarros as $i => $carro){
            echo "<p>".($i+1)."° Carro, Modelo:".$carro->getModelo()." Cor:".$carro->getCor()."</p><br>";
        }

    }

}



?>