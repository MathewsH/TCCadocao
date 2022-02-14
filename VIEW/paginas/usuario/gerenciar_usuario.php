<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

    <!-- Include cabeçalho -->

    <?php
    include_once "../fixos/cabecalho_fixo.php";
    ?>
    <head

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">      

        <!--css criado para paginas desse estilo de gerenciamento-->
       

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
                    <div class="table-title">
                        <div class="row">
                            <div class="w3-bar w3-xlarge w3-white w3-opacity w3-hover-opacity-off">
                                <center><h2 style="padding: 25px;">Gerenciar <b>Usuarios</b></h2></center>
                            </div>

                            <div class="d-grid gap-2 col-6 mx-auto" style="padding: 25px;">
                                <center>
                            
                                    <a href="../../../Controller/UsuarioController.php?acao=listaradmin"  title="Listar Usuarios" class="btn btn-primary" role="button">Exibir usuarios administradores</a>
                                       
                                    
                                    <a href="../../../Controller/UsuarioController.php?acao=listarnormal"   class="btn btn-primary" data-toggle='tooltip' title="Listar Usuarios" role="button">Exibir usuarios padrão</a>
                                     
                                    
                                    <a href="../../../Controller/UsuarioController.php?acao=listarUsuarios"   class="btn btn-primary" data-toggle='tooltip' title="Listar Usuarios" role="button">Exibir todos</a>
                                      
                                    </center>
                            </div>

                        </div>
                    </div>
                    <table class="table table-striped table-hover" style="margin-bottom: 40rem;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Endereco</th>
                                <th>Tipo</th>
                                <th>Ações</th>
                          
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $registrosObtidos = unserialize($_SESSION['listaUsuarios']);
                            foreach ($registrosObtidos as $UsuarioOBJ) {
                                ?>

                                <tr>
                                    <td><?php echo $UsuarioOBJ->getId_Usuario(); ?></td>
                                    <td><?php echo $UsuarioOBJ->getNomeusuario(); ?></td>
                                    <td><?php echo $UsuarioOBJ->getEmail(); ?></td>
                                    <td><?php echo $UsuarioOBJ->getTelefone(); ?></td>
                                    <td><?php echo $UsuarioOBJ->getendereco(); ?></td>
                                    <td><?php echo $UsuarioOBJ->getTipo(); ?></td>
                                    <td>
                                        <a href="../../../Controller/UsuarioController.php?acao=Administrador&id=<?php echo $UsuarioOBJ->getId_Usuario(); ?>&tipo=NORMAL"  class="normal" data-toggle='tooltip'>
                                            <i class="material-icons" data-toggle="tooltip" title="Virar comum">account_box</i></a> 
                                        <a href="../../../Controller/UsuarioController.php?acao=Administrador&id=<?php echo $UsuarioOBJ->getId_Usuario(); ?>&tipo=ADMINISTRADOR"  class="edit" data-toggle='tooltip'>
                                            <i class="material-icons" data-toggle="tooltip" title="Virar administrador">account_circle</i></a>                                                                              

                                    </td>
                              
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>        
        



    </body>

    <!-- Include rodapé -->
    <?php
    include_once("../fixos/rodape.html");
    ?>
</html>
