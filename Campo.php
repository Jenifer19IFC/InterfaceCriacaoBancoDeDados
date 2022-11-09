<?php

class Campo{

    public $nome;
    public $tipo;
    public bool $pk;
    public bool $nn;
    public bool $uq;
    public bool $b;
    public bool $un;
    public bool $zf;
    public bool $ai;
    public bool $g;

    function getNome(){
        return $this->nome;
    }
    function setNome($nome){
        $this->nome = $nome;
    }

    function getTipo(){
        return $this->tipo;
    }
    function setTipo($tipo){
        $this->tipo = $tipo;
    }

    function isPk() {
		return $this->pk;
	}
	function setPk($pk) {
		$this->pk = $pk;
	}

    function isNn() {
		return $this->nn;
	}
	function setNn($nn) {
		$this->nn = $nn;
	}

    function isUq() {
		return $this->uq;
	}
	function setUq($uq) {
		$this->uq = $uq;
	}

    function isB() {
		return $this->b;
	}
	function setB($b) {
		$this->b = $b;
	}

    function isUn() {
		return $this->un;
	}
	function setUn($un) {
		$this->un = $un;
	}

    function isZf() {
		return $this->pk;
	}
	function setZf($zf) {
		$this->zf = $zf;
	}

    function isAi() {
		return $this->ai;
	}
	function setAi($ai) {
		$this->ai = $ai;
	}

    function isG() {
		return $this->g;
	}
	function setG($g) {
		$this->g = $g;
	}

	

}

?>