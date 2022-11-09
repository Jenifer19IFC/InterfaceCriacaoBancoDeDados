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
  </head>
  <body>
  <form action= "formTabela.php" method="GET">

    <fieldset>
        <br><b>TABELA:</b><br><br>
      
        <label for="tab">Nome tabela:</label>
        <input type="text" id="tab" name="tab"><br><br>
        

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

  <a href="formCampo.php">Adicionar campos</a>
  </fieldset><br><br>
  <input type="submit" id = "sub" value="Salvar dados"><br><br>


  </fieldset>

  </form>
  </form>
    </form> 
  </body>
</html>