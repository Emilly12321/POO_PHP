<?php 

require_once 'Aberturas.php';
require_once 'Porta.php';
require_once 'Janelas.php';


class Casa {

    private string $descricao;
    private string $cor;
    private array $listaDePortas = [];
    private array $listaDeJanelas = [];
    private int $quartos = 0;
    private int $banheiros = 0;
    private float $tamanho = 0.0;


    
    public function getQuartos():int{
        return $this->quartos;

    }

     public function setQuartos(int $quartos):void{
        $this->quartos = $quartos;
    }


    
    
    public function getBanheiros():int{
        return $this->banheiros;
        
    }
    
    public function setBanheiros(int $banheiros):void{
       $this->banheiros = $banheiros;
   }


       
    public function getTamanho():float{
        return $this->tamanho;
    }

     public function setTamanho(float $tamanho):void{
        $this->tamanho = $tamanho;
    }




    public function getDescricao():string{
        return $this->descricao;

    }



    public function setDescricao(string $descricao):void{

        $this->descricao = $descricao;

    }

    public function getCor():string{
        return $this->cor;
    }

    public function setCor(string $cor):void{
        $this->cor = $cor;
    }

    public function getListaDePortas():array{
        return $this->listaDePortas;
    }

    public function setListaDePortas(array $listaDePortas):void{
        $this->listaDePortas = $listaDePortas;
    }


    public function getListaDeJanelas():array{
        return $this->listaDeJanelas;
    }

    public function setListaDeJanelas(array $listaDeJanelas):void{
        $this->listaDeJanelas = $listaDeJanelas;
    }


    // retorna tudo que está aberto Janelas ou Portas
    public function getAberturasPorTipo(string $tipo):array{
        if($tipo === 'porta'){
            return $this->listaDePortas;
        }else if ($tipo === 'janelas'){
            return $this->listaDeJanelas;

        }else{
            return [];
        }

    }

    // Pesquisar sobre esse tipo
    public function retornaAbertura(string $tipo, int $indice): ?Aberturas {

        $lista = $this->getAberturasPorTipo($tipo);
        return $lista[$indice] ?? null;

    }

    public function moverAbertura(Aberturas $abertura, int $novoEstado):void {
        $abertura->setEstado($novoEstado);
    }

    public function getInfoCasa():string {
        $info = "<h2>Informações da Casa </h2>";
        $info .= "<p><strong>Descrição:</strong>{$this->descricao} </p>";
        $info .= "<p><strong>Cor:</strong>{$this->cor}</p>";
        $info .= "<p><strong>Tamanho em M²:</strong>{$this->tamanho}</p>";
        $info .= "<p><strong>Quantidade de Quartos:</strong>{$this->quartos}</p>";
        $info .= "<p><strong>Quantidade de Banheiros:</strong>{$this->banheiros}</p>";

        $info .= "<h3>Portas: </h3>";
        if(!empty($this->listaDePortas)){
            foreach($this->listaDePortas as $portas){
                $estado = $portas->getEstadoTexto(); /* Utilizando o método implementado em Abertura */
                $info .= "<p>{$portas->getDescricao()} - {$estado}</p>";
            }
        }else{
            $info .= "<p>Nenhuma porta cadastrada</p>";
        }

        $info .= "<h3>Janelas: </h3>";
        if(!empty($this->listaDeJanelas)){
            foreach($this->listaDeJanelas as $janela){
                $estado = $janela->getEstadoTexto();
                $info .= "<p>{$janela->getDescricao()} - {$estado}</p>";
            }
        }else{
            $info .= "<p>Nenhuma janela cadastrada</p>";
        }
        return $info;
    }

}


?>