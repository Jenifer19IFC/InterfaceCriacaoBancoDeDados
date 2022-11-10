<?php
require_once('Campo.php');
require_once('Tabela.php');
require_once('DataBase.php');
require_once('Conn.php');
require_once('Executador.php');
require_once('Sgbd.php');

session_start();

$executadorObject = unserialize($_SESSION['executadorObject']);


?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Tabelas</title>
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
  <body>
  <form action= "formTabela.php" method="GET">

    <fieldset>
      <div class="container">
        <br><h4><b>ADICIONAR TABELA:</b></h4><br>
        <label for="tab">Nome tabela:</label>
        <input type="text" id="tab" name="tab"><br><br>
      </div>
       
        

        <?php

          $bExist = false;

          $tab = isset($_GET['tab']) ? $_GET['tab'] : "";
          
          if(empty($executadorObject->db->listTabelas)){
            if(!($tab == null)){
              $tabela = new Tabela();
              $tabela->setNome($tab);
    
              $tabelaSerializada = serialize($tabela);
              $_SESSION['tabela'] = $tabelaSerializada;
            }
            
          }else
            $bExist = false;
            for($i=0;$i < count($executadorObject->db->listTabelas); $i++){
                if($executadorObject->db->listTabelas[$i]->getNome() ==  $tab){
                    $bExist = true;
                }
            }
          if($bExist == false){
            if(!($tab == null)){
                $tabela = new Tabela();
                $tabela->setNome($tab);
      
                $tabelaSerializada = serialize($tabela);
                $_SESSION['tabela'] = $tabelaSerializada;
            }
          }

    
        ?>
        <div class="container2">
        <input type="submit" id = "sub" value="Salvar dados"><br><br>
          <a href="formCampo.php">Adicionar campos</a><br><br>
          
        </div>
</fieldset><br><br>

  </fieldset>

  </form>
  </form>
    </form> 
  </body>
</html>