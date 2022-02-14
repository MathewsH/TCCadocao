<?php

include_once("../MODEL/Animais.php");
include_once("../MODEL/listaadotados.php");


class AnimaisDAO {

    private $conn;

    public function __construct() {
        $controle = ControleConexao::getInstance();
        $this->conn = $controle->get('Connection');
    }
 
    public function buscarTodos() {
        $statement = $this->conn->query(
                'SELECT * FROM tccadocao.animais where deleted = 0'
        );
 
        return $this->processaResultados($statement);
    }
    
    public function buscarStatus($status) {
        $statement = $this->conn->query(
                'SELECT * FROM tccadocao.animais where deleted = 0 and status="'.$status.'";'
        );
 
        return $this->processaResultados($statement);
    }
    
        public function buscarSeusAdotados($id) {
        $statement = $this->conn->query(
                'SELECT * FROM tccadocao.animais join adocao on id_adocao=fk_id_adocao join usuario on id_usuario=fk_id_usuario where fk_id_usuario="'.$id.'";'
        );
 
        return $this->processaResultadosADOTADOS($statement);
    }
    
            public function buscarAdotadosUsuarios() {
        $statement = $this->conn->query(
                'SELECT * FROM tccadocao.animais join adocao on id_adocao=fk_id_adocao join usuario on id_usuario=fk_id_usuario ;'
        );
 
        return $this->processaResultadosADOTADOS($statement);
    }
    
                public function buscarAdotadosUsuarios2($id) {
        $statement = $this->conn->query(
                'SELECT * FROM tccadocao.animais join adocao on id_adocao=fk_id_adocao join usuario on id_usuario=fk_id_usuario where id_usuario="'.$id.'";'
        );
 
        return $this->processaResultadosADOTADOS($statement);
    }
    
    public function buscaradotados() {
        $statement = $this->conn->query(
                "SELECT * FROM tccadocao.animais where status='resgatado' or status='adotado' AND deleted = 0"
        );
 
        return $this->processaResultados($statement);
    }
    
    public function buscarTipo($tipo) {
        $statement = $this->conn->query(
                'SELECT * FROM tccadocao.animais where deleted = 0 and tipoanimal="'.$tipo.'" AND deleted = 0;'
        );
 
        return $this->processaResultados($statement);
    }

    public function buscarRegistro(int $id) {

        $statement = $this->conn->query(
                'SELECT * FROM tccadocao.animais WHERE id_animais ='. $id .' AND deleted = 0'
        );

        return $this->processaResultados($statement);
    }
    
    public function adotar(Adocao $adocao) {
        $this->conn->beginTransaction();

        try {
            $stmt = $this->conn->prepare(
                    'INSERT INTO adocao (data, statusAdocao, fk_id_usuario)  '
                    . 'VALUES (:data, :statusAdocao,:fk_id_usuario)'
            );


            $stmt->bindValue(':statusAdocao', $adocao->getstatus());
            $stmt->bindValue(':data', $adocao->getdata());
            $stmt->bindValue(':fk_id_usuario', $adocao->getfk_id_usuario());
            $stmt->execute();

            $id_insert = $this->conn->lastInsertId();
            $this->conn->commit();

            return $id_insert;
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }
    
    
    public function inserir(Animais $animais) {
        $this->conn->beginTransaction();

        try {
            $stmt = $this->conn->prepare(
                    'INSERT INTO animais (nome, tipoanimal, status, local,descricao)  '
                    . 'VALUES (:nome,:tipoanimal,:status, :local,:descricao)'
            );


            $stmt->bindValue(':nome', $animais->getNome());
            $stmt->bindValue(':tipoanimal', $animais->gettipo());
            $stmt->bindValue(':status', $animais->getstatus());
            $stmt->bindValue(':local', $animais->getlocal());
            $stmt->bindValue(':descricao', $animais->getdescricao());
            $stmt->execute();



            $this->conn->commit();
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }
    
    public function inseriranimal(Animais $animal, $idanimal) {
        $this->conn->beginTransaction();
        try {
            $stmt = $this->conn->prepare(
                    'UPDATE tccadocao.animais SET fk_id_adocao=:fk_id_adocao, status=:status WHERE id_animais=:id_animais and deleted=0;'
            );
            $stmt->bindValue(':id_animais', $idanimal);
            $stmt->bindValue(':fk_id_adocao', $animal->getfk_id_adocao());
            $stmt->bindValue(':status', $animal->getstatus());

            $stmt->execute();



            $this->conn->commit();
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }
    
    
        public function conhecendoanimal(Animais $animal, $idanimal) {
        $this->conn->beginTransaction();
        try {
            $stmt = $this->conn->prepare(
                    'UPDATE tccadocao.animais SET fk_id_adocao=:fk_id_adocao, status=:status WHERE id_animais=:id_animais and deleted=0;'
            );
            $stmt->bindValue(':id_animais', $idanimal);
            $stmt->bindValue(':fk_id_adocao', $animal->getfk_id_adocao());
            $stmt->bindValue(':status', $animal->getstatus());

            $stmt->execute();



            $this->conn->commit();
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }
    public function inseririmagem(Animais $animais,$arquivo, $tipo) {
        $this->conn->beginTransaction();

        try {
            $stmt = $this->conn->prepare(
                    'INSERT INTO animais (nome, tipoanimal, imagem,imagemextensao, status, local, descricao)  '
                    . 'VALUES (:nome,:tipo, :imagem,:imagemextensao, :status, :local, :descricao)'
            );


            $stmt->bindValue(':nome', $animais->getNome());
            $stmt->bindValue(':tipo', $animais->gettipo());
            $stmt->bindValue(':imagem', $arquivo,PDO::PARAM_LOB);
            $stmt->bindValue(':imagemextensao', $tipo);
            $stmt->bindValue(':status', $animais->getstatus());
            $stmt->bindValue(':local', $animais->getlocal());
            $stmt->bindValue(':descricao', $animais->getdescricao());
            $stmt->execute();



            $this->conn->commit();
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }
    
    public function atualizar(Animais $animais) {
        $this->conn->beginTransaction();
        try {
            $stmt = $this->conn->prepare(
                    'UPDATE tccadocao.animais SET nome=:nome,tipoanimal=:tipo, status=:status,descricao=:descricao, local=:local WHERE id_animais=:id_animais and deleted=0;'
            );
            $stmt->bindValue(':id_animais', $animais->getId_animais());
            $stmt->bindValue(':nome', $animais->getNome());
            $stmt->bindValue(':tipo', $animais->getTipo());
            $stmt->bindValue(':status', $animais->getstatus());
            $stmt->bindValue(':local', $animais->getlocal());
            $stmt->bindValue(':descricao', $animais->getdescricao());

            $stmt->execute();



            $this->conn->commit();
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }
    
    public function atualizarimagem(Animais $animais,$arquivo, $tipo) {
        $this->conn->beginTransaction();
        try {
            $stmt = $this->conn->prepare(
                    'UPDATE tccadocao.animais SET :nome,:tipoanimal,:imagem,:imagemextensao, :status,:descricao, :local WHERE id_animais=:id_animais'
            );
            
            $stmt->bindValue(':id_animais', $animais->getId_animais());
            $stmt->bindValue(':nome', $animais->getNome());
            $stmt->bindValue(':tipo', $animais->getTipo());
            $stmt->bindValue(':imagem', $arquivo,PDO::PARAM_LOB);
            $stmt->bindValue(':imagemextensao', $tipo);
            $stmt->bindValue(':status', $animais->getStatus());
            $stmt->bindValue(':local', $animais->getLocal());
            $stmt->bindValue(':descricao', $animais->getdescricao());

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
                $animal = new animais();

                $animal->setId_animais($row->id_animais);
                $animal->setNome($row->nome);
                $animal->setImagem($row->imagem);
                $animal->setTipo($row->tipoanimal);
                $animal->setDescricao($row->descricao);
                $animal->setStatus($row->status);
                $animal->setLocal($row->local);
                $animal->setImagemextesao($row->imagemextensao);
                $resultados[] = $animal;
            }
        }

        return $resultados;
    }
    
        private function processaResultadosADOTADOS($statement) {
        $resultados = array();

        if ($statement) {
            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $listaadotados = new listaadotados();

                $listaadotados->setId_animais($row->id_animais);
                $listaadotados->setNome($row->nome);
                $listaadotados->setImagem($row->imagem);
                $listaadotados->setTipo($row->tipoanimal);
                $listaadotados->setDescricao($row->descricao);
                $listaadotados->setStatus($row->status);
                $listaadotados->setLocal($row->local);
                $listaadotados->setImagemextensao($row->imagemextensao);
                $listaadotados->setStatusAdocao($row->statusAdocao);
                $listaadotados->setData($row->data);
                $listaadotados->setFk_id_usuario($row->fk_id_usuario);
                $listaadotados->setFk_id_adocao($row->fk_id_adocao);
                $listaadotados->setnomeusuario($row->nomeusuario);
                $listaadotados->setendereco($row->endereco);
                $listaadotados->setemail($row->email);
               
                $resultados[] = $listaadotados;
            }
        }

        return $resultados;
    }
    

    
    public function remover(int $id) {
        $this->conn->beginTransaction();

        try {

            $stmt = $this->conn->prepare(
                    'UPDATE tccadocao.animais SET deleted=1 WHERE id_animais=:animais'
            );

            $stmt->bindValue(':animais', $id);
            $stmt->execute();

            $this->conn->commit();
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }
    
        public function removeradocao(int $id) {
        $this->conn->beginTransaction();

        try {

            $stmt = $this->conn->prepare(
                    'DELETE FROM adocao WHERE id_adocao=:adocao;'
            );

            $stmt->bindValue(':adocao', $id);
            $stmt->execute();

            $this->conn->commit();
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }
    
            public function removeranimal(int $id_animal) {
        $this->conn->beginTransaction();

        try {

            $stmt = $this->conn->prepare(
                    'UPDATE tccadocao.animais SET fk_id_adocao=null, status="sem dono" WHERE id_animais=:animal;'
            );

            $stmt->bindValue(':animal', $id_animal);
            $stmt->execute();

            $this->conn->commit();
        } catch (Exception $e) {
            print_r($e);
            $this->conn->rollback();
        }
    }

}

?>