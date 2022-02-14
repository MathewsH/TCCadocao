<?php
session_start();
include_once("../configuracao/ControleConexao.php");
include_once("../DAO/AnimaisDAO.php");
include_once("../MODEL/Animais.php");
include_once("../DAO/AdocaoDAO.php");
include_once("../MODEL/Adocao.php");
include_once("../DAO/UsuarioDAO.php");
include_once("../MODEL/Usuario.php");
include_once("../configuracao/conexao.php");

$REQUEST = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

// Armazenar essa instância no Controlador
$controleConexao = ControleConexao::getInstance();
$controleConexao->set('Connection', $conn);

//Instanciar a classe DAO para utilizarmos os seus métodos posteriormente
$AnimaisDAO = new AnimaisDAO();

$acao = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_STRING);
switch ($acao) {
    
    
    case $acao == "remover":
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $AnimaisDAO->remover($id);

        $listaanimal = $AnimaisDAO->buscarTodos();
        
        $_SESSION['listaanimal'] = serialize($listaanimal);

        header('location: ../VIEW/paginas/animais/gerenciar_animais.php');
        break;
    
    case $acao == "listarcachorro":

        $listaAnimais = $AnimaisDAO->buscarTipo('cachorro');
        unset($_SESSION['listaanimal']);
        $_SESSION['listaanimal'] = serialize($listaAnimais);
        header('location: ../VIEW/paginas/animais/gerenciar_animais.php');
        exit();
        break;
    
    case $acao == "listargatos":

        $listaAnimais = $AnimaisDAO->buscarTipo('gato');
        unset($_SESSION['listaanimal']);
        $_SESSION['listaanimal'] = serialize($listaAnimais);
        header('location: ../VIEW/paginas/animais/gerenciar_animais.php');
        exit();
        break;
    
    case $acao == "editar":
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        unset($_SESSION['editar_animal']);

        $resultado = $AnimaisDAO->buscarRegistro($id);
        $_SESSION['editar_animal'] = serialize($resultado[0]);


        header('location: ../VIEW/paginas/animais/cadastrar_animais.php');
        exit();
        break;
    
    case $acao == "adotar":
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        unset($_SESSION['adocao']);

        $resultado = $AnimaisDAO->buscarRegistro($id);
        $_SESSION['adocao'] = serialize($resultado[0]);


        header('location: ../VIEW/paginas/adocao/adotar.php');
        exit();
        break;
    
        case $acao == "conhecer":
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        unset($_SESSION['conhecer']);

        $resultado = $AnimaisDAO->buscarRegistro($id);
        $_SESSION['conhecer'] = serialize($resultado[0]);


        header('location: ../VIEW/paginas/adocao/conhecer.php');
        exit();
        break;
    
    case $acao == "adotaranimal":
        $idanimal = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $usuarioLogado = unserialize($_SESSION['usuario_logado']);
        $dataAtual = date('Y-m-d H:i:s');
        unset($_SESSION['adocao']);
        
            $adocao = new Adocao();

            $adocao->setData($dataAtual);

            //realizamos a verificação do usuário na sessão e pegamos o seu ID
            if (isset($_SESSION['usuario_logado'])) {
                $adocao->setFk_id_usuario($usuarioLogado->getId_usuario());
            }
            $adocao->setStatus("Adoção");
            $inseriradocao = $AnimaisDAO->adotar($adocao);
            $adocao->setId_adocao($inseriradocao);
            $animal = new animais();
            $animal->setFk_id_adocao($inseriradocao);
            $animal->setStatus("adotado");
            $AnimaisDAO->inseriranimal($animal,$idanimal);
            
            $listaAnimais = $AnimaisDAO->buscarStatus('sem dono');
        unset($_SESSION['listaanimaladocao']);
        $_SESSION['listaanimaladocao'] = serialize($listaAnimais);
        header('location: ../VIEW/paginas/adocao/adocao.php');
        exit();
        break;
        
        case $acao == "conheceranimal":
        $idanimal = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $usuarioLogado = unserialize($_SESSION['usuario_logado']);
        $dataAtual = date('Y-m-d H:i:s');
        unset($_SESSION['adocao']);
        
            $adocao = new Adocao();

            $adocao->setData($dataAtual);

            //realizamos a verificação do usuário na sessão e pegamos o seu ID
            if (isset($_SESSION['usuario_logado'])) {
                $adocao->setFk_id_usuario($usuarioLogado->getId_usuario());
            }
            $adocao->setStatus("Conhecendo");
            $inseriradocao = $AnimaisDAO->adotar($adocao);
            $adocao->setId_adocao($inseriradocao);
            $animal = new animais();
            $animal->setFk_id_adocao($inseriradocao);
            $animal->setStatus("conhecendo");
            $AnimaisDAO->conhecendoanimal($animal,$idanimal);
            
            $listaAnimais = $AnimaisDAO->buscarStatus('sem dono');
        unset($_SESSION['listaanimaladocao']);
        $_SESSION['listaanimaladocao'] = serialize($listaAnimais);
        header('location: ../VIEW/paginas/adocao/adocao.php');
        exit();
        break;
    
    case $acao == "adicionar":
        $_SESSION['editar_animal'] = serialize(new animais());
        header('location: ../VIEW/paginas/animais/cadastrar_animais.php');
        exit();
        break;
    
    
    case $acao == "cadastroanimal":
        if ($REQUEST == "POST") {
            $id_animais = filter_input(INPUT_POST, 'id_animais', FILTER_DEFAULT);
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $tipoa = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);
            $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
            $local = filter_input(INPUT_POST, 'local', FILTER_DEFAULT);
    
            $animalNovo = new animais();
            $animalNovo->setId_animais($id_animais);
            $animalNovo->setlocal($local);
            $animalNovo->setNome($nome);
            $animalNovo->setstatus($status);
            $animalNovo->settipo($tipoa);
            $animalNovo->setdescricao($descricao);
          
            // Chamar o método inserir criado no DAO.
            if($animalNovo->getId_animais() == null){
                if(count($_FILES) > 0){
                    if(is_uploaded_file($_FILES['imgUpload']['tmp_name'])){
                        $tipo = $_FILES["imgUpload"]["type"];
                        
                        $arquivo = fopen($_FILES['imgUpload']['tmp_name'],'rb');
                        $AnimaisDAO->inserirImagem($animalNovo,$arquivo,$tipo);
                        fclose($arquivo);
                        var_dump($animalNovo,$arquivo,$tipo);
                    }
                }
                
                unset($_SESSION['mensagemSistema']);
                $_SESSION['mensagemSistema'] = 'animal adicionada com sucesso!';
            } else{
               $AnimaisDAO->atualizar($animalNovo);
                
                    }
                 
                unset($_SESSION['mensagemSistema']);
                $_SESSION['mensagemSistema'] = 'animal editado com sucesso!';
            

           atualizarListaAdmin();
            exit();
        }
        break;

    case $acao == "listaranimais":
        atualizarListaAdmin();
        break;
    
    case $acao == "listaradotados":
        
        $listaAnimais = $AnimaisDAO->buscarSeusAdotados(unserialize($_SESSION['usuario_logado'])->getId_usuario());
        unset($_SESSION['listaadocao']);
        $_SESSION['listaadocao'] = serialize($listaAnimais);
        header('location: ../VIEW/paginas/adocao/gerenciar_adocao.php');
        exit();
        break;
    
        case $acao == "listaradotadosUsuarios":
        
        $listaAnimais = $AnimaisDAO->buscarAdotadosUsuarios();
        unset($_SESSION['listaadocaousuarios']);
        $_SESSION['listaadocaousuarios'] = serialize($listaAnimais);
        header('location: ../VIEW/paginas/adocao/gerenciar_adocao_usuario.php');
        exit();
        break;
    
    case $acao == "listaranimaisadocao":
        
        $listaAnimais = $AnimaisDAO->buscarStatus('sem dono');
        unset($_SESSION['listaanimaladocao']);
        $_SESSION['listaanimaladocao'] = serialize($listaAnimais);
        header('location: ../VIEW/paginas/adocao/adocao.php');
        exit();
        break;
    
    case $acao == "listaranimaisadotado":
        
        $listaAnimaisAdotados = $AnimaisDAO->buscaradotados();
        unset($_SESSION['listaanimaladotado']);
        $_SESSION['listaanimaladotado'] = serialize($listaAnimaisAdotados);
        header('location: ../index.php');
        exit();
        break;
    
        case $acao == "removeradocao":
            
        $id_animal = filter_input(INPUT_GET, 'idanimal', FILTER_SANITIZE_NUMBER_INT);
        $AnimaisDAO->removeranimal($id_animal);
        
        
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $AnimaisDAO->removeradocao($id);

        $listaAnimais = $AnimaisDAO->buscarAdotadosUsuarios();
        unset($_SESSION['listaadocaousuarios']);
        $_SESSION['listaadocaousuarios'] = serialize($listaAnimais);
        header('location: ../VIEW/paginas/adocao/gerenciar_adocao_usuario.php');
        break;
    
          case $acao == "removeradocao2":
            
        $id_animal = filter_input(INPUT_GET, 'idanimal', FILTER_SANITIZE_NUMBER_INT);
        $AnimaisDAO->removeranimal($id_animal);
        
        
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $AnimaisDAO->removeradocao($id);

        $listaAnimais = $AnimaisDAO->buscarAdotadosUsuarios2($id);
        unset($_SESSION['listaadocaousuarios']);
        $_SESSION['listaadocaousuarios'] = serialize($listaAnimais);
        header('location: ../VIEW/paginas/adocao/gerenciar_adocao_usuario.php');
        break;
    
    
    default:
        break;
    


    
    
}


function atualizarListaAdmin() {
    buscarTodos();
    header('location: ../VIEW/paginas/animais/gerenciar_animais.php');
    exit();
}

//busca todos as imagens e insere na session

function buscarTodos() {
    // Chamar o método buscarTodos() criado no DAO.
    global $AnimaisDAO;
    $resultados = $AnimaisDAO->buscarTodos();
    unset($_SESSION['listaanimal']);
    $_SESSION['listaanimal'] = serialize($resultados);
}



