<?php 

require_once 'Carro.php';
class Fabrica{  
    private array $guardarCarros = [];

    public function fabricarCarros(array $carro):void{
        foreach($carro as $carro){
            $this->guardarCarros[$i] = $carro;
        }
    }

    public function venderCarros(string $modelo, string $cor):bool{
    
        foreach($this->guardarCarros as $i => $guardarCarros){

            if( $guardarCarros->getModelo() === $modelo &&  $guardarCarros->getCor() === $cor){

                unset($this->guardarCarros[$i]);
                return true;

            }
            
        }
        return false;
        
    }



    public function mostrarCarros():void{

        $this->guardarCarros = array_values($this->guardarCarros);

        foreach($this->guardarCarros as $i => $carro){
            echo "<p>".($i+1)."° Carro: <br> <strong>Modelo:</strong> ". $carro->getModelo()." ||  <strong>Cor:</strong> ".$carro->getCor()."</p><br><br>";
        }

    }

}



?>