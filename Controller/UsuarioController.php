<?php

session_start();
//incluir o model e o DAO usuario
include_once("../DAO/UsuarioDAO.php");
include_once("../MODEL/Usuario.php");
include_once("../DAO/AnimaisDAO.php");
include_once("../MODEL/Animais.php");
include_once("../configuracao/conexao.php");
include_once("../configuracao/ControleConexao.php");

$REQUEST = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

// Armazenar essa instância no Controlador
$controleConexao = ControleConexao::getInstance();
$controleConexao->set('Connection', $conn);

//Instanciar a classe DAO para utilizarmos os seus métodos posteriormente
$usuarioDAO = new UsuarioDAO();
$AnimaisDAO = new AnimaisDAO();

$acao = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING);
switch ($acao) {
    case $acao == "cadastroUsuario":
        if ($REQUEST == "POST") {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $senha = filter_input(INPUT_POST, 'senha', FILTER_UNSAFE_RAW);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $telefone = filter_input(INPUT_POST, 'telefone', FILTER_DEFAULT);
            $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);


            // Instanciando novo Usuário e setando informações
            $usuarioNovo = new Usuario();
            $usuarioNovo->setEmail($email);
            $usuarioNovo->setNomeusuario($nome);
            $usuarioNovo->setSenha($senha);
            $usuarioNovo->setTipo("NORMAL");
            $usuarioNovo->setTelefone($telefone);
            $usuarioNovo->setendereco($endereco);
            
            
            $validaremail = $usuarioDAO->validaremail($email);
            var_dump($validaremail);
            if(empty($validaremail)){
            $usuarioDAO->inserir($usuarioNovo);


            $_SESSION['mensagemSistema'] = 'Usuário cadastrado com sucesso!';
            //location para a pagina de login apos fazer o cadastro
           header("location: ../VIEW/paginas/login/login.php");
            }
            else{
                $_SESSION['mensagemSistema'] = 'Email ja existente';
                header("location: ../VIEW/paginas/login/cadastro_usuario.php");
            }
            exit();
        }
        break;

        case $acao == "perfil":
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $Usuario = $usuarioDAO->buscarRegistro($id);

        unset($_SESSION['usuario_logado']);
        $_SESSION['usuario_logado'] = serialize($Usuario[0]);
        
        header("location: ../VIEW/paginas/usuario/perfil.php");
        break;
        
    case $acao == "listarUsuarios":
        $listaUsuarios = $usuarioDAO->buscarTodos();
        unset($_SESSION['listaUsuarios']);
        $_SESSION['listaUsuarios'] = serialize($listaUsuarios);
        //pagina para gerenciamento do usuario e listagem dele
        if (isset($_SESSION['usuario_logado'])&& unserialize($_SESSION['usuario_logado'])->getTipo() == "ADMINISTRADOR"){
        header('location: ../VIEW/paginas/usuario/gerenciar_usuario.php');
        }
        else {
            header("location: ../index.php");
    }
        exit();
        break;
        
    case $acao == "listaradmin":

        $listaUsuarios = $usuarioDAO->buscarUsuarioTipo("ADMINISTRADOR");
        unset($_SESSION['listaUsuarios']);
        $_SESSION['listaUsuarios'] = serialize($listaUsuarios);
        header('location: ../VIEW/paginas/usuario/gerenciar_usuario.php');
        exit();
        break;
       
    case $acao == "listarnormal":

        $listaUsuarios = $usuarioDAO->buscarUsuarioTipo("NORMAL");
        unset($_SESSION['listaUsuarios']);
        $_SESSION['listaUsuarios'] = serialize($listaUsuarios);
        header('location: ../VIEW/paginas/usuario/gerenciar_usuario.php');
        exit();
        break;
    
    
    case $acao == "remover":
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $usuarioDAO->remover($id);

        $listaUsuarios = $usuarioDAO->buscarTodos();
        
        $_SESSION['listaUsuarios'] = serialize($listaUsuarios);
        //pagina para gerenciamento do usuario e listagem dele
        header('location: ../VIEW/paginas/usuario/gerenciar_usuario.php');
        break;
    
    case $acao == "editar":
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        unset($_SESSION['editar_usuario']);

        $resultado = $usuarioDAO->buscarRegistro($id);
        $_SESSION['editar_usuario'] = serialize($resultado[0]);


        header('location: ../VIEW/paginas/usuario/cadastro_usuario.php');
        exit();
        break;
    
    case $acao == "adicionar":
        $_SESSION['editar_usuario'] = serialize(new Usuario());
        header('location: ../VIEW/paginas/usuario/cadastro_usuario.php');
        exit();
        break;
    
    case $acao == "editarsenha":
        header('location: ../VIEW/paginas/usuario/trocarsenha.php');
        exit();
        break;
    
    case $acao == "trocasenha":
        if ($REQUEST == "POST") {
            $id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_DEFAULT);
            $senha = filter_input(INPUT_POST, 'senha', FILTER_UNSAFE_RAW);
            $usuarioNovo = new usuario();
            $usuarioNovo->setId_usuario($id_usuario);
            $usuarioNovo->setSenha($senha);
                $usuarioDAO->atualizarsenha($usuarioNovo);
            
        header("location: ../index.php");
        exit();
        }
        break;
        
    case $acao == "Administrador":
     $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $tipo = filter_input(INPUT_GET, 'tipo', FILTER_DEFAULT);
        $usuarioDAO->atualizaradm($id, $tipo);
        $listaUsuarios = $usuarioDAO->buscarTodos();
        unset($_SESSION['listaUsuarios']);
        $_SESSION['listaUsuarios'] = serialize($listaUsuarios);
        header('location: ../VIEW/paginas/usuario/gerenciar_usuario.php');

        break;

    
    case $acao == "logout":
        //tirando o usuario da sessão
        session_destroy();
        //location para a tela inicial do site
        header("location: ../index.php");
        
        exit();
        break;

    case $acao == "login":
        //location para a pagina de login
        header("location: ../VIEW/paginas/login/login.php");
        break;
    
    case $acao == "efetuarLogin":
        $login = filter_input(INPUT_POST, 'loginInserido', FILTER_SANITIZE_STRING);
        $senha = filter_input(INPUT_POST, 'senhaLogin', FILTER_UNSAFE_RAW);

        // Chamar o método validarLogin criado no DAO. Os dados obtidos do usuário são inseridos na variável $resultados
        $resultado = $usuarioDAO->validarLogin($login, $senha);

        //pegamos o primeiro resultado, como é um login é o único que deve retornar!
        //processo para armazenar o objeto usuário retornado na sessão, também é utilizado o serialize para garantir que o objeto será inserido totalmente
        //para realizar o processo inverso basta utilizar o comando unserialize()
        unset($_SESSION['usuario_logado']);

        if (!empty($resultado)) {
            $_SESSION['usuario_logado'] = serialize($resultado[0]);
            //redirecionamento para a página inicial após realizar o login
            if (unserialize($_SESSION['usuario_logado'])->gettipo() == "ADMINISTRADOR"){
                $listaUsuarios = $usuarioDAO->buscarTodos();
        
        $_SESSION['listaUsuarios'] = serialize($listaUsuarios);
                header("location: ../VIEW/paginas/usuario/gerenciar_usuario.php");
                exit();
            }
            elseif (unserialize($_SESSION['usuario_logado'])->getTipo() == "NORMAL"){
                 $listaAnimaisAdotados = $AnimaisDAO->buscaradotados();
        unset($_SESSION['listaanimaladotado']);
        $_SESSION['listaanimaladotado'] = serialize($listaAnimaisAdotados);
        header('location: ../index.php');
                 exit();
            }
            
            exit();
        } else if (empty($resultado)) {
            $_SESSION['mensagemSistemaver'] = 'Login ou Senha Inválidos!';
            //location para a pagina login com uma mensagem de erro dps do login invalido 
            header("location: ../VIEW/paginas/login/login.php");
            exit();
        }

        break;


    default:
        break;
}

