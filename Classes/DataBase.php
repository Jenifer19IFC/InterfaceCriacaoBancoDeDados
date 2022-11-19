<?php

class DataBase{

    public $nome;
    public $collation = "utf8mb4_general_ci";
    public $characterset = "utf8mb4";
    public $listTabelas = array();

    function getNome(){
        return $this->nome;
    }
    function setNome($nome){
        $this->nome = $nome;
    }

    function getCollation(){
        return $this->collation;
    }
    function setCollation($collation){
        $this->collation = $collation;
    }

    function getCharacterset(){
        return $this->characterset;
    }
    function setCharacterset($characterset){
        $this->characterset = $characterset;
    }

    function getListTabelas() {
		return $this->listTabelas;
	}
	function setListTabelas($listTabelas = array()) {
		$this->listTabelas = $listTabelas;
	}

	

}

?>