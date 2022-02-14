<!DOCTYPE html>
<!--
Adicionar atributo "nome" na tabela categoria
-->
<html>

    <!-- Include cabeçalho -->

    <?php
    include_once "../fixos/cabecalho_fixo.php";
    require_once __RAIZ__ . '/MODEL/listaadotados.php';
    
    
    
    ?>
    <head

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">      

      <!--  css criado para paginas desse estilo de gerenciamento-->

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


      
            <div class="table-striped" style="height: 800px;">
                <div class="table-wrapper">
                    
                </div>
                                                    <div class="table-title">
                        <div class="row">
                            <div class="w3-bar w3-xlarge w3-white w3-opacity w3-hover-opacity-off">
                                <br><center><h2>Gerenciar suas <b>adoções</b></h2></center><br>
                            </div>

                        </div>
                    </div>
                                    
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
                            
                                
                                <th>Nome</th>
                                
                                <th>Tipo</th>
                                
                                <th>Descrição</th>

                                <th>Status</th>

                                <th>Local</th>
                                
                                <th>Data</th>
                                
                                <th>Status da Adoção</th>

                                <th>Imagem</th>

                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $registrosObtidos = unserialize($_SESSION['listaadocao']);

                            foreach ($registrosObtidos as $listaadotadosOBJ) {
                                ?> 

                             <tr>
                                
                                    <td><?php echo $listaadotadosOBJ->getNome(); ?></td>
                                    <td><?php echo $listaadotadosOBJ->gettipo(); ?></td>
                                    <td><?php echo $listaadotadosOBJ->getDescricao(); ?></td>
                                    <td><?php echo $listaadotadosOBJ->getStatus(); ?></td>
                                    <td><?php echo $listaadotadosOBJ->getLocal(); ?></td>
                                    <td><?php echo $listaadotadosOBJ->getData(); ?></td>
                                    <td><?php echo $listaadotadosOBJ->getStatusAdocao(); ?></td>
                                    <td>
                                    <?php 
                                        
                                            //forçamos para ficar uma imagem 100x100 e padronizada
                                        echo '<img src="data:'.$listaadotadosOBJ->getImagemextensao().';base64,'.base64_encode($listaadotadosOBJ->getImagem()).'" style="width:100px;height:100px;" />';
                                    
                                        ?>
                                       
                                    </td>
                                    <td> 
                                                 
                                        <a href="../../../Controller/AnimaisController.php?acao=removeradocao2&id=<?php echo $listaadotadosOBJ->getFk_id_adocao(); ?>&idanimal=<?php echo $listaadotadosOBJ->getId_animais(); ?>" class="delete" data-toggle='tooltip'>
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
