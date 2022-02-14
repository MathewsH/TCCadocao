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
    require_once __RAIZ__ . '/MODEL/Animais.php';

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
     if (unserialize($_SESSION['usuario_logado'])->getTipo() != "ADMINISTRADOR"):
                        header("location: ../aluno/tela_final.php");
                        exit();
                    endif;

    $id_animais = unserialize($_SESSION['editar_animal'])->getId_animais();
    $local = unserialize($_SESSION['editar_animal'])->getlocal();
    $nome = unserialize($_SESSION['editar_animal'])->getNome();
    $tipo = unserialize($_SESSION['editar_animal'])->gettipo();
    $status = unserialize($_SESSION['editar_animal'])->getStatus();
    $descricao = unserialize($_SESSION['editar_animal'])->getdescricao();
    ?> 

    <head

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">       

        <link rel="stylesheet" type="text/css" href="../css/style.css">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


    </head>

    <body>


       
<center>
                <!-- Icone inserido -->
                <div class="fadeIn first">
                    <h3><?php echo $id_animais==null?"Cadastro":"Edição" ?> de imagens</h3>
               
                </div>


                <!-- Formulário de login -->
                <form method="post" action="../../../Controller/AnimaisController.php?acao=cadastroanimal" enctype="multipart/form-data">


                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="hidden"  class="form-control" id="id_animais" name="id_animais"  value="<?php echo $id_animais; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nome " class="col-sm-2 col-form-label">Nome:</label>
                        <div class="col-sm-10">
                            <input type="text"  class=" form-control" id="nome" name="nome" placeholder=""  value="<?php echo $nome; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="local " class="col-sm-2 col-form-label">Local de encontro:</label>
                        <div class="col-sm-10">
                            <input type="text"  class=" form-control" id="local" name="local" placeholder=""  value="<?php echo $local; ?>">
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="tipo" class="col-sm-2 col-form-label">Tipo:</label>
                        <div class="col-sm-10">
                            <select name="tipo" id="tipo" class="form-control">
                              <option value="<?php echo $tipo;?>"><?php echo $tipo; ?></option>
                                <option value="cachorro">cachorro</option>
                                <option value="gato">gato</option>
                                </select> 
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="local " class="col-sm-2 col-form-label">Descrição:</label>
                        <div class="col-sm-10">
                            <input type="text"  class=" form-control" id="descricao" name="descricao" placeholder=""  value="<?php echo $descricao; ?>">
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">Status:</label>

                        <div class="col-sm-10">
                           
                            <select name="status" id="status" class="form-control">
                              <option value="<?php echo $status; ?>"><?php echo $status;?></option>
                                <option value="adotado">adotado</option>
                                <option value="resgatado">resgatado</option>
                                <option value="sem dono">sem dono</option>
                                <option value="adocao em andamento">adocao em andamento</option>
                                <option value="conhecendo">conhecendo</option>
                        
                            </select>    
                            
                        </div>
                    </div>
                    
            <?php if ($id_animais == null): ?>
                    <input name="imgUpload" type="file" />
                    <?php endif; ?> 

                    <input type="submit" class="fadeIn second" name="upload" value="<?php echo $id_animais==null?"Cadastrar":"Editar" ?>" />

            </div>
        </form>


</center>


</body>

 
</html>
