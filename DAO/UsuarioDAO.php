<?php

include_once("../MODEL/Usuario.php");

class UsuarioDAO {

    private $conn;

    public function __construct() {
        $controle = ControleConexao::getInstance();
        $this->conn = $controle->get('Connection');
    }
    
    public function validarLogin(String $login, String $senha) {
        $this->conn->beginTransaction();

        try {
            //aqui é explicito o schema principal
            $stmt = $this->conn->prepare('SELECT * FROM tccadocao.usuario WHERE email=:email AND senha=:senha AND deleted=0'
            );


            $stmt->bindValue(':email', $login);
            $stmt->bindValue(':senha', sha1($senha));
            $stmt->execute();


            $this->conn->commit();
            return $this->processaResultados($stmt);
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }
    
        public function validaremail(String $email) {
        $this->conn->beginTransaction();

        try {
            //aqui é explicito o schema principal
            $stmt = $this->conn->prepare('SELECT * FROM tccadocao.usuario WHERE email=:email AND deleted=0'
            );


            $stmt->bindValue(':email', $email);
            
            $stmt->execute();


            $this->conn->commit();
            return $this->processaResultados($stmt);
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }
 
    public function buscarTodos() {
        $statement = $this->conn->query(
                'SELECT * FROM tccadocao.usuario WHERE deleted=0'
        );

        return $this->processaResultados($statement);
    }
    
    public function buscarUsuarioTipo($tipo) {


        $statement = $this->conn->query(
                'SELECT * FROM tccadocao.usuario WHERE deleted=0 and tipo="'.$tipo.'";'
        );


        return $this->processaResultados($statement);
    }

    public function buscarRegistro(int $id) {

        $statement = $this->conn->query(
                'SELECT * FROM tccadocao.usuario WHERE id_usuario='. $id .' AND deleted=0'
        );

        return $this->processaResultados($statement);
    }

    public function inserir(Usuario $usuario) {
        $this->conn->beginTransaction();

        try {
            $stmt = $this->conn->prepare(
                    'INSERT INTO usuario (nomeusuario,endereco, email, telefone, senha, tipo)  VALUES (:nome,:endereco, :email, :telefone, :senha, :Tipo)'
            );


            $stmt->bindValue(':nome', $usuario->getNomeusuario());
            $stmt->bindValue(':senha', sha1($usuario->getSenha()));
            $stmt->bindValue(':endereco',$usuario->getendereco());
            $stmt->bindValue(':telefone', $usuario->getTelefone());
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':Tipo', $usuario->getTipo());
            $stmt->execute();



            $this->conn->commit();
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }

    public function atualizar(Usuario $usuario) {
        $this->conn->beginTransaction();
        try {
            $stmt = $this->conn->prepare(
                    'UPDATE tccadocao.usuario SET nomeusuario=:nome,endereco=:endereco, email=:email, senha=:senha, telefone=:telefone, tipo=:Tipo WHERE id_usuario=:id_usuario'
            );

            
            $stmt->bindValue(':nome', $usuario->getNome());
            $stmt->bindValue(':senha', sha1($usuario->getSenha()));
            $stmt->bindValue(':endereco', sha1($usuario->getendereco()));
            $stmt->bindValue(':telefone', $usuario->getTelefone());
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':Tipo', $usuario->getTipo());
            $stmt->bindValue(':id_usuario', $usuario->getId_usuario());
            $stmt->execute();



            $this->conn->commit();
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }

    
        public function atualizaradm($id, $tipo) {
        $this->conn->beginTransaction();
        try {
            $stmt = $this->conn->prepare(
                    'UPDATE tccadocao.usuario SET tipo=:tipo WHERE id_usuario=:id_usuario'
            );

            $stmt->bindValue(':id_usuario', $id);
            $stmt->bindValue(':tipo', $tipo);
            $stmt->execute();



            $this->conn->commit();
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }
    
    public function atualizarsenha(Usuario $usuario) {
        $this->conn->beginTransaction();
        try {
            $stmt = $this->conn->prepare(
                    'UPDATE tccadocao.usuario SET senha=:senha WHERE id_usuario=:id_usuario'
            );

            $stmt->bindValue(':senha', sha1($usuario->getSenha()));
            $stmt->bindValue(':id_usuario', $usuario->getId_usuario());
            $stmt->execute();



            $this->conn->commit();
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }

    private function processaResultados($statement) {
        $resultados = array();

        if ($statement) {
            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $usuario = new usuario();

                $usuario->setId_usuario($row->id_usuario);
                $usuario->setNomeusuario($row->nomeusuario);
                $usuario->setEmail($row->email);
                $usuario->setSenha($row->senha);
                $usuario->setEndereco($row->endereco);
                $usuario->setTelefone($row->telefone);
                $usuario->setTipo($row->tipo);
                $resultados[] = $usuario;
            }
        }

        return $resultados;
    }

    public function remover(int $id) {
        $this->conn->beginTransaction();

        try {

            $stmt = $this->conn->prepare(
                    'UPDATE tccadocao.usuario SET deleted=1 WHERE id_usuario=:idInserido'
            );

            $stmt->bindValue(':idInserido', $id);
            $stmt->execute();

            $this->conn->commit();
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }

}

?>