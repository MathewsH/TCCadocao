
<html>
    
        
<title>TCC Adoção</title>

<body>
<!-- barra lateral) -->
<meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <link rel="stylesheet" href="../../../css/style.css"/>
<?php
    include_once "../fixos/cabecalho_fixo.php";
    require_once __RAIZ__ . '/MODEL/Animais.php';
    ?>

<!-- !conteudo da pagina ! -->
<br><center><h3>Adoção</h3></center><br>
<center>
<div class="w3-container w3-padding-32 w3-center">  
    <h3>Animais para adoção</h3><br>
    <div class=" d-flex justify-content-center flex-wrap container-fluid">

 <?php
                            $registrosObtidos = unserialize($_SESSION['listaanimaladocao']);

                            foreach ($registrosObtidos as $animaisOBJ) {
                                ?> 
    
    	<div clas=""style="padding: 50px;">
		<div class="card text-center mb-3 text-success " style="max-width: 25rem;">
			<div class="card-header ">
				<h5 class="card-title text-dark"><?php echo $animaisOBJ->getNome(); ?></h5>
				<h6 class="text-muted"><?php echo $animaisOBJ->getStatus(); ?></h6>
			</div>
			<div class="card-body ">
				<div class="card-title"><?php 
                                        
                                        
                                        echo '<img src="data:'.$animaisOBJ->getImagemextensao().';base64,'.base64_encode($animaisOBJ->getImagem()).'" style="width:300px;height:300px;" />';
                                    
                                        ?></div>
				<p class="card-text"><?php echo $animaisOBJ->getdescricao(); ?></p>
                               
           
			</div>
                     <div class="card-header ">
				<a type="button" class="btn btn-outline-secondary" href="../../../Controller/AnimaisController.php?acao=adotar&id=<?php echo $animaisOBJ->getId_animais() ?>">Adotar</a>
                                <a type="button" class="btn btn-outline-secondary" href="../../../Controller/AnimaisController.php?acao=conhecer&id=<?php echo $animaisOBJ->getId_animais() ?>">Conhecer</a>
			</div>

	</div>
	</div>
    <?php } ?>

  </div>
    <div class="w3-padding-32">
      
    </div>
  </div>
    </center>
    </body>
                <?php
    include_once("../fixos/rodape.html");
    ?>
</html>
