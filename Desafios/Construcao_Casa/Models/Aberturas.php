<?php 

abstract class Aberturas{

    protected string $descricao;
    protected int $estado;

    public function getDescricao():string{
        return $this->descricao;
    }

    public function setDescricao(string $descricao):void{
        $this->descricao = $descricao;
    }

    public function getEstado():int{
        return $this->estado;
    }

    
    public function setEstado(int $estado):void{
        $this->estado = $estado;
    }

    public function abrir():void{
        $this->estado=1;
    }

    
    public function fechar():void{
        $this->estado=0;
    }

    public function getEstadoTexto():string{
        return $this->estado === 1 ? "Aberta" : "Fechada";
    }



}




?>