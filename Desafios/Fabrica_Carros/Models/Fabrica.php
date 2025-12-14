    <?php 

    class Fabrica{  
        private array $guardarVeiculos = [];

        public function fabricarVeiculos(array $veiculo):void{
            foreach($veiculo as $veiculo){
                $this->guardarVeiculos[] = $veiculo;
            }
        }

        public function venderVeiculos(string $modelo, string $cor):bool{
        
            foreach($this->guardarVeiculos as $i => $guardarVeiculos){

                if( $guardarVeiculos->getModelo() === $modelo &&  $guardarVeiculos->getCor() === $cor){

                    unset($this->guardarVeiculos[$i]);
                    $this->guardarVeiculos = array_values($this->guardarVeiculos);
                    return true;

                }
                
            }
            return false;
            
        }

        public function mostrarTipoVeiculos($tipo):void{

            echo "<h3>Em estoque".$tipo.": </h3>";

            foreach($this->guardarVeiculos as $i => $veiculo){
                
                if($veiculo instanceof $tipo){
                    echo "<p><strong>Modelo:</strong> ". $veiculo->getModelo()." ||  <strong>Cor:</strong> ".$veiculo->getCor()."</p><br><br>";
                }
            }
            
        }



        public function mostrarVeiculos():void{


            foreach($this->guardarVeiculos as $i => $veiculo){
                
                if($veiculo instanceof Motos ){
                echo "<h3>".($i+1)."  Moto: </h3><br>";
                }else{
                    echo "<h3>".($i+1)."  Carro: </h3><br>";
                }
                echo "<p><strong>Modelo:</strong> ". $veiculo->getModelo()." ||  <strong>Cor:</strong> ".$veiculo->getCor()."</p><br><br>";
                
            }
            
        }

    }



    ?>