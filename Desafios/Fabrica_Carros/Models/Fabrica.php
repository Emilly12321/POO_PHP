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
            echo $tipo." :";
            $teste = false;
            foreach($this->guardarVeiculos as $i => $veiculo){

                if($veiculo instanceof $tipo){
                    echo " <div class='mostrar-veiculo'><p><strong>Modelo:</strong> ". $veiculo->getModelo()." <br>  <strong>Cor:</strong> ".$veiculo->getCor()."</p></div><br><br>";
                    $teste = true;
                }

            }

            if(!$teste){
                echo "<p>Nao encontrado</p>";
            }

            
        }



        public function mostrarVeiculos():void{


            foreach($this->guardarVeiculos as $i => $veiculo){
                
                if($veiculo instanceof Motos ){
                echo "<h3>".($i+1)."  Moto: </h3><br>";
                }else{
                    echo "<h3>".($i+1)."  Carro: </h3><br>";
                }
                echo "<div class='mostrar-veiculo'><p><strong>Modelo:</strong> ". $veiculo->getModelo()." <br>  <strong>Cor:</strong> ".$veiculo->getCor()."</p></div>";
                
            }
            
        }

    }



    ?>