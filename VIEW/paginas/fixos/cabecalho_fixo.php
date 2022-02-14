<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

    <head>
        <?php
        include_once '../../../configuracao/Constantes.php';
        require_once __RAIZ__ . '/MODEL/Usuario.php';

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        
        ?>

        <script>
            // ações do menu
            function openMenu(evt, menuName) {
                var i, x, tablinks;
                x = document.getElementsByClassName("menu");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablink");
                for (i = 0; i < x.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
                }
                document.getElementById(menuName).style.display = "block";
                evt.currentTarget.firstElementChild.className += " w3-red";
            }
            document.getElementById("myLink").click();
        </script>
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

        
         <!--tentativa de adicionar bootstrap-->
         
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
        
          <!--fim de adicionar bootstrap-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>MP Adoções</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
       
        <style>
            
            body, html {height: 100%}
            body,h1,h2,h3,h4,h5,h6 {font-family: sans-serif}
            .menu {display: none}
            .bgimg {
                background-repeat: no-repeat;
                background-size: cover;
                min-height: 90%;
            }
        </style> 
    </head>
    <body>

        <?php        
        if (!isset($_SESSION['usuario_logado'])): ?>
           <div class="container-fluid navbar navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand hiperlink" href="../../../Controller/AnimaisController.php?acao=listaranimaisadotado">
      			<i class="bi bi-house-fill border border-1 rounded-3 "  style='font-size:25px; padding:5px; background-color: #20ac6b; color: white; margin-right: 5px;' ></i>SAAR - Um site para adoção de animais em situação de rua</a>
		</div>
	</div>
           <div class="sticky-top  container-fluid navbar-dark bg-dark">
                <header class="d-flex justify-content-center py-3">
                    <ul class="nav" id="myNavbar">
                 
                    <li class="nav-item">
			<a class="nav-link hiperlink text-light btn btn-outline-success" style="margin-right:10px;" href="../../../Controller/AnimaisController.php?acao=listaranimaisadotado">Início</a>
                    </li>
                    <li class="nav-item">
			<a class="nav-link hiperlink text-light btn btn-outline-success" style="margin-right:10px;"href="../../../Controller/UsuarioController.php?acao=login">Login</a>
                    </li>
                </ul>
                </header>
                   
            </div> 

        <?php 
            
        elseif (unserialize($_SESSION['usuario_logado'])->getTipo() == "ADMINISTRADOR"): ?>
            <div class="container-fluid navbar navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand hiperlink" href="../../../Controller/AnimaisController.php?acao=listaranimaisadotado">
      			<i class="bi bi-house-fill border border-1 rounded-3 "  style='font-size:25px; padding:5px; background-color: #20ac6b; color: white; margin-right: 5px;' ></i>SAAR - Um site para adoção de animais em situação de rua</a>
		</div>
	</div>
            <div class="sticky-top  container-fluid navbar-dark bg-dark">
                <header class="d-flex justify-content-center py-3">
                    <ul class="nav" id="myNavbar">
                    <!--<a href="#" class="w3-bar-item w3-button">HOME</a> <a href="#menu" class="w3-bar-item w3-button">MENU</a>-->
                    <li class="nav-item">
			<a class="nav-link hiperlink text-light btn btn-outline-success" style="margin-right:10px;" href="../../../Controller/AnimaisController.php?acao=listaranimaisadotado">Início</a>
                    </li>
                    <li class="nav-item">
			<a class="nav-link hiperlink text-light btn btn-outline-success" style="margin-right:10px;"href="../../../Controller/AnimaisController.php?acao=listaranimaisadocao">Adoção</a>
                    </li>
                    <li class="nav-item">
					<a class="nav-link hiperlink text-light btn btn-outline-success" style="margin-right:10px;"href="../../../Controller/UsuarioController.php?acao=listarUsuarios">Gerenciar usuarios</a>
                    </li>
                    <li class="nav-item">
					<a class="nav-link hiperlink text-light btn btn-outline-success" style="margin-right:10px;"href="../../../Controller/AnimaisController.php?acao=listaranimais">Gerenciar Animais</a>
                    </li>
                    <li class="nav-item">
					<a class="nav-link hiperlink text-light btn btn-outline-success" style="margin-right:10px;"href="../../../Controller/AnimaisController.php?acao=listaradotados">Suas Adoções</a>
                    </li>
                    <li class="nav-item">
					<a class="nav-link hiperlink text-light btn btn-outline-success" style="margin-right:10px;"href="../../../Controller/AnimaisController.php?acao=listaradotadosUsuarios">Adoções concluidas</a>
                    </li>
                    <li class="nav-item">
					<a class="nav-link hiperlink text-light btn btn-outline-success" style="margin-right:10px;"href="../../../Controller/UsuarioController.php?acao=editarsenha">Alterar senha</a>
                    </li>
                     <li class="nav-item">
					<a class="nav-link hiperlink text-light btn btn-outline-success" style="margin-right:10px;"href="../../../Controller/UsuarioController.php?acao=logout">Logout</a>
                    </li>
                </ul>
                </header>
            </div>  
        <?php elseif (unserialize($_SESSION['usuario_logado'])->getTipo() == "NORMAL"): ?>
           <div class="container-fluid navbar navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand hiperlink" href="../../../Controller/AnimaisController.php?acao=listaranimaisadotado">
      			<i class="bi bi-house-fill border border-1 rounded-3 "  style='font-size:25px; padding:5px; background-color: #20ac6b; color: white; margin-right: 5px;' ></i>SAAR - Um site para adoção de animais em situação de rua</a>
		</div>
	</div>
            <div class="sticky-top  container-fluid navbar-dark bg-dark">
                <header class="d-flex justify-content-center py-3">
                    <ul class="nav" id="myNavbar">
                    <!--<a href="#" class="w3-bar-item w3-button">HOME</a> <a href="#menu" class="w3-bar-item w3-button">MENU</a>-->
                    <li class="nav-item">
			<a class="nav-link hiperlink text-light btn btn-outline-success" style="margin-right:10px;" href="../../../Controller/AnimaisController.php?acao=listaranimaisadotado">Início</a>
                    </li>
                    <li class="nav-item">
			<a class="nav-link hiperlink text-light btn btn-outline-success" style="margin-right:10px;"href="../../../Controller/AnimaisController.php?acao=listaranimaisadocao">Adoção</a>
                    </li>
                    <li class="nav-item">
					<a class="nav-link hiperlink text-light btn btn-outline-success" style="margin-right:10px;"href="../../../Controller/AnimaisController.php?acao=listaradotados">Suas Adoções</a>
                    </li>
                    <li class="nav-item">
					<a class="nav-link hiperlink text-light btn btn-outline-success" style="margin-right:10px;"href="../../../Controller/UsuarioController.php?acao=editarsenha">Alterar senha</a>
                    </li>
                     <li class="nav-item">
					<a class="nav-link hiperlink text-light btn btn-outline-success" style="margin-right:10px;"href="../../../Controller/UsuarioController.php?acao=logout">Logout</a>
                    </li>
                </ul>
                </header>
            </div> 
        <?php endif; ?>

    </body>

</html>
