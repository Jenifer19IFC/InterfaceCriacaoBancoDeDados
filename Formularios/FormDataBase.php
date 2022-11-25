<?php
require_once('../Classes./Campo.php');
require_once('../Classes./Tabela.php');
require_once('../Classes./DataBase.php');
require_once('../Classes./Conn.php');
require_once('../Classes./Executador.php');
require_once('../Classes./Sgbd.php');

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
    margin-left: 36rem;
    margin-right: auto; 
    }
 

  </style>
  </head>
  <body class="p-3 mb-2 bg-dark text-white ">
  <form action= "" method="GET">

    <fieldset>
        <div class="container">
            <br><h5><b><label for="nomeDb" class="form-label">Conexão</label></b></h5>
            <label for="usuario" class="form-label">Usuário</label>
            <input type="text" class="form-control" id="usuario" aria-describedby="usuario" name="usuario">
            <label for="senha" class="form-label">Senha</label>
            <input type="text" class="form-control" id="senha" aria-describedby="senha" name="senha">
            <label for="host" class="form-label">Host</label>
            <input type="text" class="form-control" id="host" aria-describedby="host" name="host">
            <label for="porta" class="form-label">Porta</label>
            <input type="text" class="form-control" id="porta" aria-describedby="porta" name="porta">
            <br>  
          
          
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
            <br><h5><b><label for="nomeDb" class="form-label">Data Base</label></b></h5>  
            <label for="nomeDb" class="form-label">Nome Data Base</label>
            <input type="text" class="form-control" id="nomeDb" aria-describedby="nomeDb" name="nomeDb">
        
        <?php
            $nomeDb = isset($_GET['nomeDb']) ? $_GET['nomeDb'] : "";
           
            $dataBase = new DataBase();
            $dataBase->setNome($nomeDb);
        ?>
    


  <form action= "" method="GET">
          <br><h5><b><label for="nomeDb" class="form-label">Executador</label></b></h5>
          <label for="nomeSgbd" class="form-label">Nome Sgbd</label>
          <select class="form-select form-select-lg-sm mb-3" aria-label=".form-select-lg example" name="nomeSgbd" readonly>
              <option value="mysql">Mysql</option>
          </select>
        
       
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
           
        <div class="form-group text-center">
            <button class="btn btn-primary" type="submit">Salvar dados</button><br><br>
            <a href="formTabela.php" class="btn btn-success" tabindex="-1" role="button" aria-disabled="false">Adicionar tabela</a>
        </div>
      
        
        </div>

        </fieldset>
  <br><br>
  

  </form>
  </form>
    </form> 
  </body>
</html>