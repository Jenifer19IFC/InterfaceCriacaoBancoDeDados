<?php

class Conexao{

   public $usuario;
   public $senha;
   public $porta;
   public $host;

    function getUsuario(){
        return $this->usuario;
    }

    function setUsuario($usuario){
        $this->usuario = $usuario;
    }

    function getSenha(){
        return $this->senha;
    }
    
    function setSenha($senha){
        $this->senha = $senha;
    }

    function getPorta(){
        return $this->porta;
    }
    
    function setPorta($porta){
        $this->porta = $porta;
    }

    function getHost(){
        return $this->host;
    }
    
    function setHost($host){
        $this->host = $host;
    }

    


}

?>