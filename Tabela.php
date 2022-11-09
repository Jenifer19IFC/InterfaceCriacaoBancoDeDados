<?php

class Tabela{

    public $nome;
    public $listCampos = array();
    

    function __concstruct(){
    }
    
    function getNome(){
        return $this->nome;
    }
    function setNome($nome){
        $this->nome = $nome;
    }

    function getListCampos() {
		return $this->listCampos;
	}

	function setListCampos($listCampos = array()) {
		$this->listCampos = $listCampos;
	}


}

?>