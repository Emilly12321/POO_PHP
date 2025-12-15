    <?php 

    class Fabrica{  
        private array $guardarVeiculos = [];

        public function fabricarVeiculos(array $veiculo):void{
            foreach($veiculo as $veiculo){
                $this->guardarVeiculos[] = $veiculo;
            }
        }

        public function venderVeiculos(string $modelo, string $cor, string $tipo):bool{
        
            foreach($this->guardarVeiculos as $i => $guardarVeiculos){

                if( $guardarVeiculos->getModelo() === $modelo &&  $guardarVeiculos->getCor() === $cor && $guardarVeiculos instanceof $tipo){

                    unset($this->guardarVeiculos[$i]);
                    $this->guardarVeiculos = array_values($this->guardarVeiculos);
                    return true;

                }
                
            }
            return false;
            
        }

        public function mostrarTipoVeiculos($tipo):void{
            $teste = false;
            foreach($this->guardarVeiculos as $i => $veiculo){

                if($veiculo instanceof $tipo){
                    echo " <div class='mostrar-veiculo'><p><strong>Modelo:</strong> ". $veiculo->getModelo()."<br><strong>Cor:</strong> ".$veiculo->getCor()."</p></div>";
                    $teste = true;
                }

            }

            if(!$teste){
                echo "<p>Não há  $tipo disponível em estoque</p>";
            }

            
        }



        public function mostrarVeiculos():void{

            $teste = false;

            foreach($this->guardarVeiculos as $i => $veiculo){
                
                echo "<div class='mostrar-veiculo'><p><strong>Categoria: </strong>".get_class($veiculo)."<br><strong>Modelo:</strong> ". $veiculo->getModelo()."<br><strong>Cor:</strong> ".$veiculo->getCor()."</p></div>";
                $teste = true;

            }
             if(!$teste){
                echo "<p>Não há nenhum veículo disponível em estoque</p>";
            }
        }

    }



    ?>