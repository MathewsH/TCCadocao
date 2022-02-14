<!DOCTYPE html>
<!--
diferenciar formularios de adm e normal -->
<html>
    
    <?php
    include_once("../fixos/cabecalho_fixo.php");
    require_once __RAIZ__ . '/Model/Usuario.php';

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
   
    $id_usuario = unserialize($_SESSION['usuario_logado'])->getId_usuario();
  
    ?> 
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">       

        <link rel="stylesheet" type="text/css" href="../css/style.css">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


    </head>

    <body>


<br>
<br>
                <center> 
                <div class="fadeIn first">

                </div>
                

                <!-- Formulário de troca de senha -->
                <form method="post" action="../../../Controller/UsuarioController.php?acao=trocasenha">

                    
                    <div class="mb-3">
  <input type="hidden"  class="form-control" id="id_usuario" name="id_usuario"  value="<?php echo $id_usuario; ?>">
</div>
<div class="mb-3">
    <h3><label for="formGroupExampleInput2" class="form-label">Nova senha:</label></h3>
  <input type="text" class="form-control" id="senha" placeholder="Insira a nova senha">
</div>

                
                    
                    
                    <input type="submit" class="fadeIn second" value="Confirmar" />
                  

           

        </form>



    </div>
</div>

</body>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

 <?php
    include_once("../fixos/rodape.html");
    ?>
</html>
