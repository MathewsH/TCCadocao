<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

    <!-- Include cabeçalho -->

    <?php
    include_once("../fixos/cabecalho_fixo.php");
    ?>
    <head

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">       

        <link rel="stylesheet" type="text/css" href="../css/style.css">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


        <style>
            /**/
            body, html {height: 100%}
            body,h1,h2,h3,h4,h5,h6 {font-family: "Amatic SC", sans-serif;font-size: 23pt}

            .menu {display: none}
            .bgimg {
                background-repeat: no-repeat;
                background-size: cover;
               
                min-height: 90%;
            }
        </style>
    </head>

    <body>


        <div class="wrapper fadeInDown">
            <div id="formContent">

                <?php if (isset($_SESSION['mensagemSistema'])): 
                    $mensagem = isset($_SESSION['mensagemSistema']) ? $_SESSION['mensagemSistema'] : "";
                    ?>
                
                    <div class = "alert alert-danger">
                        <strong><?php echo $mensagem; ?></strong> 
                    </div>

                <?php
                unset($_SESSION['mensagemSistema']);
                endif; ?>
                
                <form class="row g-3" method="post" action="../../../Controller/UsuarioController.php?acao=cadastroUsuario">
  <div class="col-12">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email"placeholder="Insira o email">
  </div>
  <div class="col-12">
    <label for="senha" class="form-label">Senha</label>
    <input type="Password" class="form-control" id="senha" name="senha"placeholder="Insira o senha">
  </div>
  <div class="col-12">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome"placeholder="Insira o nome">
  </div>
  <div class="col-12">
    <label for="telefone" class="form-label">Telefone</label>
    <input type="text" class="form-control" id="telefone" name="telefone"placeholder="Insira o telefone">
  </div>
  <div class="col-12">
    <label for="endereco" class="form-label">Endereco</label>
    <input type="text" class="form-control" id="endereco" name="endereco"placeholder="Insira o endereço">
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Cadastrar</button>
  </div>
</form>


            </div>
        </div>

    </body>

    <!-- Include rodapé -->
    <?php
    include_once("../fixos/rodape.html");
    ?>
</html>
