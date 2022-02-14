<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
    include_once "../fixos/cabecalho_fixo.php";
    require_once __RAIZ__ . '/MODEL/Animais.php';
    ?>
        <title>Adoção</title>
    </head>
    <body>
        		<div class=" container-fluid" style="margin-top: 25px; margin-bottom: 40px; ">
			<div class="card mb-3 ">
				<div class="card-header text-center text-muted fonteZ">
					<h5>Formulario para conhecer o animal</h5>
				</div>
				<div class="card-body text-center" style="padding-top: 20px;">
                                    <?php 
                                        
                                            //forçamos para ficar uma imagem 100x100 e padronizada
        echo '<img src="data:'.unserialize($_SESSION['conhecer'])->getImagemextensao().';base64,'.base64_encode(unserialize($_SESSION['conhecer'])->getImagem()).'" style="width:400px;height:400px;" />';
                                    
                                        ?>
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item"><?php echo unserialize($_SESSION['conhecer'])->getNome(); ?></li>
                            <li class="list-group-item"><?php echo unserialize($_SESSION['conhecer'])->getStatus(); ?></li>
                            <li class="list-group-item"><?php echo unserialize($_SESSION['conhecer'])->getdescricao(); ?></li>
                            <li class="list-group-item"><?php echo unserialize($_SESSION['conhecer'])->getTipo(); ?></li>
                            
                          </ul>
			  </div>
                            				<div class="card-body text-center" style="padding-top: 20px;">
                                                            
                                <a type="button" class="btn btn-outline-success" href="../../../Controller/AnimaisController.php?acao=conheceranimal&id=<?php echo  unserialize($_SESSION['conhecer'])->getId_animais() ?>">Conhecer</a>
                                <a type="button" class="btn btn-outline-danger" href="../../../Controller/AnimaisController.php?acao=listaranimaisadocao">Voltar</a>
      
			  </div>
				</div>
				</div>
    </body>
            <?php
    include_once("../fixos/rodape.html");
    ?>
</html>
