<!DOCTYPE html>
<!--
Adicionar atributo "nome" na tabela categoria
-->
<html>

    <!-- Include cabeçalho -->

    <?php
    include_once "../fixos/cabecalho_fixo.php";
    require_once __RAIZ__ . '/MODEL/Animais.php';
    
     if (unserialize($_SESSION['usuario_logado'])->getTipo() != "ADMINISTRADOR"):
                        header("location: ../aluno/tela_final.php");
                        exit();
                    endif;
    ?>
    <head

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">      


        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

        <!--Icones-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">




        <script>
            $(document).ready(function () {
                // Activate tooltip
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>



    </head>

    <body>


        
            <div class="table table-striped">
                <div class="table-wrapper">
                </div>
                                    <div class="table-title">
                        <div class="row">
                            <div class="w3-bar w3-xlarge w3-white w3-opacity w3-hover-opacity-off">
                                <center><h2 style="padding: 10px;">Gerenciar <b>Animais</b></h2></center>
                                                               <center> <a href="../../../Controller/AnimaisController.php?acao=adicionar"   class="btn btn-outline-primary" data-toggle='tooltip' title="Adicionar nova imagem" >
                                    <i class="material-icons">&#xe145</i> <span> ADICIONAR NOVO ANIMAL </span></a></center>   <br>
                            </div>

                            <div class="d-grid gap-2 col-6 mx-auto" style="padding-bottom: 25px;" >
                                <center>
                            
                                    <a href="../../../Controller/AnimaisController.php?acao=listarcachorro"  title="Listar Usuarios" class="btn btn-primary" role="button">Exibir cães</a>
                                       
                                    
                                    <a href="../../../Controller/AnimaisController.php?acao=listargatos"   class="btn btn-primary" data-toggle='tooltip' title="Listar gatos" role="button">Exibir gatos</a>
                                     
                                    
                                    <a href="../../../Controller/AnimaisController.php?acao=listaranimais"   class="btn btn-primary" data-toggle='tooltip' title="Listar todos" role="button">Exibir todos</a>
                                      
                                    </center>
                            </div>

                        </div>
                    </div>
                            <div class="col-xs-7"> 
                    <?php
                    if (isset($_SESSION['mensagemSistema'])):
                        $mensagem = isset($_SESSION['mensagemSistema']) ? $_SESSION['mensagemSistema'] : "";
                        ?>

                        <div class = "alert alert-info">
                            <strong><?php echo $mensagem; ?></strong> 
                        </div>

                        <?php
                        unset($_SESSION['mensagemSistema']);
                    endif;
                    ?>
                                <table class="table table-striped table-hover" style="margin-bottom: 40rem;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                
                                <th>Nome</th>
                                
                                <th>Tipo</th>
                                
                                <th>Descrição</th>

                                <th>Status</th>

                                <th>Local</th>

                                <th>Imagem</th>

                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $registrosObtidos = unserialize($_SESSION['listaanimal']);

                            foreach ($registrosObtidos as $animaisOBJ) {
                                ?> 

                             <tr>
                                    <td><?php echo $animaisOBJ->getId_animais(); ?></td>
                                    <td><?php echo $animaisOBJ->getNome(); ?></td>
                                    <td><?php echo $animaisOBJ->gettipo(); ?></td>
                                    <td><?php echo $animaisOBJ->getDescricao(); ?></td>
                                    <td><?php echo $animaisOBJ->getStatus(); ?></td>
                                    <td><?php echo $animaisOBJ->getLocal(); ?></td>
                                    <td>
                                    <?php 
                                        
                                            //forçamos para ficar uma imagem 100x100 e padronizada
                                        echo '<img src="data:'.$animaisOBJ->getImagemextensao().';base64,'.base64_encode($animaisOBJ->getImagem()).'" style="width:100px;height:100px;" />';
                                    
                                        ?>
                                       
                                    </td>
                                    <td> 
                                        
                                        <a href="../../../Controller/AnimaisController.php?acao=editar&id=<?php echo $animaisOBJ->getId_animais(); ?>"  class="edit" data-toggle='tooltip'>
                                            <i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>         
                                        <a href="../../../Controller/AnimaisController.php?acao=remover&id=<?php echo $animaisOBJ->getId_animais(); ?>" class="delete" data-toggle='tooltip'>
                                            <i class="material-icons" data-toggle="tooltip" title="Deletar">&#xe16c;</i></a>  
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        
                        
                    </table>       

                 
                </div>
            </div>        
       


    </body>
        <?php
    include_once("../fixos/rodape.html");
    ?>
</html>
