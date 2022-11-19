<?php

class Executador{

   public $conn;
   public $db;
   public $sgbd;
   
    function __construct(){
        $this->conn = new Conexao();
        $this->db = new DataBase();
        $this->sgbd = new Sgbd();
    }
   
    function getConn(){
        return $this->conn;
    }

    function setConn($conn){
        $this->conn = $conn;
    }

    function getDb(){
        return $this->db;
    }
    function setDb($db){
        $this->db = $db;
    }

    function getSgbd(){
        return $this->sgbd;
    }
    
    function setSgbd($sgbd){
        $this->sgbd = $sgbd;
    }



}

?>