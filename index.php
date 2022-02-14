
<html>
    
        
<title>TCC Adoção</title>

<body>
<!-- barra lateral) -->
<meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <link rel="stylesheet" href="../../../css/style.css"/>
<?php
    include_once "cabecalho.php";
    require_once __RAIZ__ . '/MODEL/Animais.php';
    ?>

<?php   


        if (!isset($_SESSION['usuario_logado'])): ?>

<div class="w3-container w3-padding-10 w3-center">  
    <h1>BEM VINDO</h1>
    
    <div class="w3-container w3-padding-10 w3-center" style="padding: 10px;">  

    <h2>Faça seu cadastro para visualizar o site com mais facilidade</h2>
    <center><a type="button" class="btn btn-outline-primary" href="VIEW/paginas/login/cadastro_usuario.php">Cadastrar-se</a>
   </center> <div class="w3-padding-32">
        <center>
    <div class=" d-flex justify-content-center flex-wrap container-fluid">
      
          	<div clas=""style="padding: 10px;">
		<div class="card text-center  border-dark mb-3 text-success " style="max-width: 25rem;">
			<div class="card-body ">
				<div class="card-title"><img src="../TCCadocao/VIEW/imagens/eredin.jpeg" style="width:250px;height:250px; padding: 0.5cm" /></div>
			</div>
	</div>
	</div>
      
                	<div clas=""style="padding: 10px;">
		<div class="card text-center  border-dark mb-3 text-success " style="max-width: 25rem;">
			<div class="card-body ">
				<div class="card-title"><img src="../TCCadocao/VIEW/imagens/pipoca1.jpeg" style="width:250px;height:250px; padding: 0.5cm" /></div>
			</div>
	</div>
	</div>
                      	<div clas=""style="padding: 10px;">
		<div class="card text-center  border-dark mb-3 text-success " style="max-width: 25rem;">
			<div class="card-body ">
				<div class="card-title"><img src="../TCCadocao/VIEW/imagens/manu1.jpeg" style="width:250px;height:250px; padding: 0.5cm" /></div>
			</div>
	</div>
	</div>
      
    </div>
    </center>
    </div>

    
    <div class="w3-padding-32">
        <center>
    <div class=" d-flex justify-content-center flex-wrap container-fluid">
      
          	<div clas=""style="padding: 10px;">
		<div class="card text-center  border-dark mb-3 text-success " style="max-width: 25rem;">
			<div class="card-body ">
				<div class="card-title"><img src="../TCCadocao/VIEW/imagens/capuccino1.jpeg" style="width:250px;height:250px; padding: 0.5cm" /></div>
			</div>
	</div>
	</div>
      
                	<div clas=""style="padding: 10px;">
		<div class="card text-center  border-dark mb-3 text-success " style="max-width: 25rem;">
			<div class="card-body ">
				<div class="card-title"><img src="../TCCadocao/VIEW/imagens/chewbacca.jpeg" style="width:250px;height:250px; padding: 0.5cm" /></div>
			</div>
	</div>
	</div>
                      	<div clas=""style="padding: 10px;">
		<div class="card text-center  border-dark mb-3 text-success " style="max-width: 25rem;">
			<div class="card-body ">
				<div class="card-title"><img src="../TCCadocao/VIEW/imagens/lilly.jpeg" style="width:250px;height:250px; padding: 0.5cm" /></div>
			</div>
	</div>
	</div>
                              	<div clas=""style="padding: 10px;">
		<div class="card text-center  border-dark mb-3 text-success " style="max-width: 25rem;">
			<div class="card-body ">
				<div class="card-title"><img src="../TCCadocao/VIEW/imagens/lua.jpeg" style="width:250px;height:250px; padding: 0.5cm" /></div>
			</div>
	</div>
	</div>
      
    </div>
    </center>
    </div>
  </div>
</div>
<?php 

elseif (unserialize($_SESSION['usuario_logado'])->getTipo() == "ADMINISTRADOR" OR unserialize($_SESSION['usuario_logado'])->getTipo() == "NORMAL"): ?>
	 
<center><h2>Animais Adotados</h2><br></center>
    
    <div class=" d-flex justify-content-center flex-wrap container-fluid">

 <?php
                            $registrosObtidos = unserialize($_SESSION['listaanimaladotado']);

                            foreach ($registrosObtidos as $animaisOBJ) {
                                ?> 
    
    	<div clas=""style="padding: 50px;">
		<div class="card text-center  mb-3 text-success " style="max-width: 25rem;">
			<div class="card-header ">
				<h5 class="card-title text-dark"><?php echo $animaisOBJ->getNome(); ?></h5>
				<h6 class="text-muted"><?php echo $animaisOBJ->getStatus(); ?></h6>
			</div>
			<div class="card-body ">
				<div class="card-title"><?php 
                                        
                                            //forçamos para ficar uma imagem 100x100 e padronizada
                                        echo '<img src="data:'.$animaisOBJ->getImagemextensao().';base64,'.base64_encode($animaisOBJ->getImagem()).'" style="width:300px;height:300px;" />';
                                    
                                        ?></div>
				<p class="card-text"><?php echo $animaisOBJ->getdescricao(); ?></p>
				
			</div>

	</div>
	</div>
    <?php } ?>

  </div>

    
       
<?php endif; ?>


  <hr id="sobre">

  <!-- pagina final-->
  <div class="w3-container w3-padding-32 w3-center">  
    <h3>Sobre nós</h3><br>
    
    <div class="w3-padding-32">
      <h4><b>Técnicos em Informática do IFMS</b></h4>
      <h6><i>Instituto Federal de Mato Grosso do Sul</i></h6>
      <img src="https://s1.static.brasilescola.uol.com.br/be/vestibular/-5aaa5c3997e04.jpg" alt="Me" class="w3-image" style="display:block;margin:auto" width="800" height="533">
    </div>
  </div>
  <hr>
  
  <!-- rodapé -->
  <?php
    include_once("VIEW/paginas/fixos/rodape.html");
    ?>

</body>
</html>
