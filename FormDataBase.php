<?php
require_once('Campo.php');
require_once('Tabela.php');
require_once('DataBase.php');
require_once('Conn.php');
require_once('Executador.php');
require_once('Sgbd.php');

session_start();

// Tabelas e campos no principal
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Form obtém  dados</title>
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
    .container3 { 
    width: 500px; 
    margin-left: auto;
    margin-right: auto; 
    }
    .container4 { 
    width: 500px; 
    margin-left: auto;
    margin-right: auto; 
    }
  </style>
  </head>
  <body>
  <form action= "" method="GET">

    <fieldset>
      <div class="container">
        <br><h5><b>CONEXAO:</b></h5><br>
        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="usuario"><br><br>
        <label for="senha">Senha:</label>
        <input type="text" id="senha" name="senha"><br><br>
        <label for="host">Host:</label>
        <input type="text" id="host" name="host"><br><br>
        <label for="porta">Porta:</label>
        <input type="text" id="porta" name="porta"><br><br>
      </div>
        

        <?php

            $nome = isset($_GET['nome']) ? $_GET['nome'] : "";
            $host = isset($_GET['host']) ? $_GET['host'] : "";
            $porta = isset($_GET['porta']) ? $_GET['porta'] : "";
            $usuario = isset($_GET['usuario']) ? $_GET['usuario'] : "";
            $senha = isset($_GET['senha']) ? $_GET['senha'] : "";

            $conn = new Conexao();
            $conn->setUsuario($usuario);
            $conn->setSenha($senha);
            $conn->setHost($host);
            $conn->setPorta($porta);


        ?>

  <form action="" method="GET">
      <fieldset>
        <div class="container2">
          <br><h5><b>DATABASE:</b></h5><br>
          <label for="nomeDb">Nome DataBase:</label>
          <input type="text" id="nomeDb" name="nomeDb"><br><br>
        </div>
       

        <?php

            $nomeDb = isset($_GET['nomeDb']) ? $_GET['nomeDb'] : "";
           
            $dataBase = new DataBase();
            $dataBase->setNome($nomeDb);
            
           
        ?>
    


  <form action= "" method="GET">
  <fieldset>
    <div class="container3">
      <br><h5><b>EXECUTADOR:</b></h5><br>
        <label for="nomeSgbd">Nome SGBD:</label>
        <input type="text" id="nomeSgbd" name="nomeSgbd" value="mysql" readonly><br><br>
    </div>
       
        <?php

            $nomeSgbd = isset($_GET['nomeSgbd']) ? $_GET['nomeSgbd'] : "";
            
            $sgbd = new Sgbd();

            if(!empty($_GET['nomeSgbd'])){
              $nomeSgbd = $_GET['nomeSgbd'];
            }
            
            $sgbd->setNome($nomeSgbd);
            $e = new Executador();
            $e->setConn($conn);
            $e->setDb($dataBase);
            $e->setSgbd($sgbd);

            //Apenas escreve o Executador em formato Json na tela
            //echo json_encode($e);
            
            $executadorSerealizado = serialize($e);
            $_SESSION['executadorObject'] = $executadorSerealizado;


        ?>
        <br>
        <div class="container4">
            <input type="submit" value="Salvar dados"><br><br>
            <a href="formTabela.php"> Adicionar tabelas</a>
          
            
        </div>
 
        </fieldset>
  </fieldset><br><br>
  </fieldset>

  </form>
  </form>
    </form> 
  </body>
</html>