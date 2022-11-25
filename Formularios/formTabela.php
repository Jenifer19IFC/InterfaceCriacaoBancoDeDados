<?php
require_once('../Classes./Campo.php');
require_once('../Classes./Tabela.php');
require_once('../Classes./DataBase.php');
require_once('../Classes./Conn.php');
require_once('../Classes./Executador.php');
require_once('../Classes./Sgbd.php');

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
    margin-left: 38.5rem;
    margin-right: auto; 
    }
  </style>
  </head>
  <body class="p-3 mb-2 bg-dark text-white">
  <form action= "formTabela.php" method="GET">

    <fieldset>
      <div class="container">
          <br><h5><b><label for="tab" class="form-label">Adicionar tabela</label></b></h5><br>
          <label for="tab" class="form-label">Nome da tabela</label>
          <input type="text" class="form-control" id="tab" aria-describedby="tab" name="tab"><br>
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
            
          }else{
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
          }
    
        ?>
        <div class="container2">
          <div class="form-group text-center">
              <button class="btn btn-primary" type="submit">Salvar dados</button><br><br>
              <a href="formCampo.php" class="btn btn-success" tabindex="-1" role="button" aria-disabled="false">Adicionar campo</a>
            </div>
        </div>
</fieldset><br><br>

  </fieldset>

  </form>
  </form>
    </form> 
  </body>
</html>