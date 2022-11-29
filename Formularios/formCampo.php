<?php
session_start();
require_once('../Classes./Tabela.php');
require_once('../Classes./Executador.php');
require_once('../Classes./Sgbd.php');
require_once('../Classes./Conn.php');
require_once('../Classes./DataBase.php');
require_once('../Classes./Campo.php');

$executadorObject = unserialize($_SESSION['executadorObject']);
if(!empty($_SESSION['tabela']))
$tabela = unserialize($_SESSION['tabela']);

?>

<!DOCTYPE HTML>
<html lang="pt-br">  
    <head>  
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<style>
    .container { 
    width: 500px; 
    margin-left: auto;
    margin-right: auto; 
    }
    .container2 { 
    width: 500px; 
    margin-left: auto;
    margin-right: auto; 
    }
  </style>
    </head>
    <body class="p-3 mb-2 bg-dark text-white">
        <div class="container">
                <br><br><h5><b><label for="nomeCampo" class="form-label">Adicionar campo</label></b></h5><br>
                <a href="FormDataBase.php" class="btn btn-warning  text-white" tabindex="-1" role="button" aria-disabled="false">Início</a> <a href="formTabela.php" class="btn btn-success" tabindex="-1" role="button" aria-disabled="false">Adicionar tabela</a>
               
                <br>
            <br>

                <form>
                    <BR>
                    <div id="formularioC">
                        <div class="form-groupC">
                            <label for="nomeCampo" class="form-label">Nome do campo</label>
                            <input type="text" class="form-control" id="nomeCampo" aria-describedby="nomeCampo" name="nomeCampo" required>

                            <br><label for="tipo" class="form-label">Tipo</label>

                            <select class="form-select form-select-lg-sm mb-3" aria-label=".form-select-lg example" name="tipos" readonly>
                                <option value="int"> <h4>int</h4></option>
                                <h4><option value="varchar(45)">varchar(45)</option></h4>
                                <h4><option value="decimal(5,3)">decimal(5,3)</option></h4>
                            </select>
                            
                            <br><input type="checkbox" name="op1" value="pk"> Chave primária
                            <br><input type="checkbox" name="op2" value="nn"> Não nulo
                            <br><input type="checkbox" name="op3" value="uq"> Único
                            <br><input type="checkbox" name="op4" value="b"> Binário
                            <br><input type="checkbox" name="op5" value="un"> Sem sinal
                            <br><input type="checkbox" name="op6" value="zf"> Zero a esquerda
                            <br><input type="checkbox" name="op7" value="ai"> Incremento automático
                            <br><input type="checkbox" name="op8" value="g"> Coluna gerada
                                
                        </div>
                    </div>
                    <div class="form-groupC">
                        <div class="form-group text-left">
                            <br><button class="btn btn-primary" type="submit">Salvar dados</button>
                        </div>
                        </div>
                    <br><br>
                    <input type="checkbox" name="fimTabela" value="fimTabela"> Finalizar tabela
                </form>
        </div>
       

        <?php

            $bExist = false;
            $nomeCampo = isset($_GET['nomeCampo']) ? $_GET['nomeCampo'] : "";
           // var_dump($nomeCampo);
          //  echo "<br>";
            $tipo = isset($_GET['tipos']) ? $_GET['tipos'] : "";
            //echo $tipo;
            echo "<br>";
            $op1= isset($_GET['op1']) ? $_GET['op1'] : "";
           // echo $op1;
           // echo "<br>";
            $op2= isset($_GET['op2']) ? $_GET['op2'] : "";
           // echo $op2;
           // echo "<br>";
            $op2= isset($_GET['op2']) ? $_GET['op2'] : "";
           // echo $op2;
           // echo "<br>";
            $op3= isset($_GET['op3']) ? $_GET['op3'] : "";
           // echo $op3;
            //echo "<br>";
            $op4= isset($_GET['op4']) ? $_GET['op4'] : "";
           // echo $op4;
           // echo "<br>";
            $op5= isset($_GET['op5']) ? $_GET['op5'] : "";
           // echo $op5;
           // echo "<br>";
            $op6= isset($_GET['op6']) ? $_GET['op6'] : "";
          //  echo $op6;
           // echo "<br>";
            $op7= isset($_GET['op7']) ? $_GET['op7'] : "";
            //echo $op7;
           // echo "<br>";
            $op8= isset($_GET['op8']) ? $_GET['op8'] : "";
           // echo $op8;
           $fimTabela = isset($_GET['fimTabela']) ? $_GET['fimTabela'] : "";
            
            if(empty($tabela->listCampos)){
                if(!($nomeCampo == null)){
                    $campo = new Campo();
                    $campo->setNome($nomeCampo);
                    $campo->setTipo($tipo);
                    $campo->setPk($op1);
                    $campo->setNn($op2);
                    $campo->setUq($op3);
                    $campo->setB($op4);
                    $campo->setUn($op5);
                    $campo->setZf($op6);
                    $campo->setAi($op7);
                    $campo->setG($op8);
                    
                    array_push($tabela->listCampos,$campo);
                    if($fimTabela == "fimTabela"){
                        array_push($executadorObject->db->listTabelas,$tabela);
                    }
                    $tabelaSerializada = serialize($tabela);
                    $_SESSION['tabela'] = $tabelaSerializada;
                    $executadorSerealizado = serialize($executadorObject);
                    $_SESSION['executadorObject'] = $executadorSerealizado;

                
                }
                
            }else
                if(!empty($_SESSION['tabela']) && !empty($tabela->listCampos)){
                $bExist = false;
                for($i=0;$i < count($tabela->listCampos); $i++){
                    if($tabela->listCampos[$i]->getNome() ==  $nomeCampo){
                        $bExist = true;
                    }
                }
                if($bExist == false){
                    if(!($nomeCampo == null)){
                        $campo = new Campo();
                        $campo->setNome($nomeCampo);
                        $campo->setTipo($tipo);
                        $campo->setPk($op1);
                        $campo->setNn($op2);
                        $campo->setUq($op3);
                        $campo->setB($op4);
                        $campo->setUn($op5);
                        $campo->setZf($op6);
                        $campo->setAi($op7);
                        $campo->setG($op8);
                        array_push($tabela->listCampos,$campo);
                        if($fimTabela == "fimTabela"){
                            array_push($executadorObject->db->listTabelas,$tabela);
                        }
                        $tabelaSerializada = serialize($tabela);
                        $_SESSION['tabela'] = $tabelaSerializada;
                        $executadorSerealizado = serialize($executadorObject);
                        $_SESSION['executadorObject'] = $executadorSerealizado;
                        
                    }

                }
                }
                    
            
            $arquivo = __DIR__ . '/arquivo.json';
            file_put_contents($arquivo, json_encode($executadorObject));


       
        ?>


    </body>
</html>