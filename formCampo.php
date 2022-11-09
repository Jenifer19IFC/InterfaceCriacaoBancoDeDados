<?php
session_start();
require_once('Tabela.php');
require_once('Executador.php');
require_once('Sgbd.php');
require_once('Conn.php');
require_once('DataBase.php');
require_once('Campo.php');

$executadorObject = unserialize($_SESSION['executadorObject']);
$tabela = unserialize($_SESSION['tabela']);

?>

<!DOCTYPE HTML>
<html lang="pt-br">  
    <head>  
        <meta charset="utf-8">
    </head>
    <body>
        <h1>Adicionar Campo </h1>
        <a href="FormDataBase.php">  Início​</a>
        

        <br><br>
        
        <a href="formTabela.php"> Adicionar tabela</a>
    <br>

        <form>
            <BR><BR>
            <div id="formularioC">
                <div class="form-groupC">
                    <label>Nome do campo: </label>
                    <input type="text" name="nomeCampo" placeholder="Digite o nome do campo"><br>
                    <label>Tipo: </label>   
                    <select name="tipos">
                        <option value="int">int</option>
                        <option value="varchar(45)">varchar(45)</option>
                        <option value="decimal(5,3)">decimal(5,3)</option>
                    </select>
                        <br><br><input type="checkbox" name="op1" value="pk"> Primary Key
                        <br><input type="checkbox" name="op2" value="nn"> Não nulo
                        <br><input type="checkbox" name="op3" value="uq"> Único
                        <br><input type="checkbox" name="op4" value="b"> Binário
                        <br><input type="checkbox" name="op5" value="un"> Não assinado
                        <br><input type="checkbox" name="op6" value="zf"> Valor 0 se for númerico
                        <br><input type="checkbox" name="op7" value="ai"> Incremento automático
                        <br><input type="checkbox" name="op8" value="g"> Coluna gerada
                        
                </div>
            </div>
            <div class="form-groupC">
                <br><input type="submit" value="Salvar dados"><br><br>
            </div>
            <br><br>
            <br><input type="checkbox" name="fimTabela" value="fimTabela"> Finalizar tabela
        </form>

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
                    
            
            $arquivo = __DIR__ . '/arquivo.json';
            file_put_contents($arquivo, json_encode($executadorObject));


       
        ?>


    </body>
</html>