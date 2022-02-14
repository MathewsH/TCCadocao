<?php


include_once("../MODEL/Adocao.php");

class AdocaoDAO {

    private $conn;

    public function __construct() {
        $controle = ControleConexao::getInstance();
        $this->conn = $controle->get('Connection');
    }
    
    public function buscarTodos() {
        $statement = $this->conn->query(
                'SELECT * FROM tccadocao.adocao WHERE deleted=0'
        );

        return $this->processaResultados($statement);
    }

    public function buscarRegistro(int $id) {

        $statement = $this->conn->query(
                'SELECT * FROM tccadocao.adocao WHERE id_adocao='. $id .' AND deleted=0'
        );

        return $this->processaResultados($statement);
    }

    public function inserir(Adocao $adocao) {
        $this->conn->beginTransaction();

        try {
            $stmt = $this->conn->prepare(
                    'INSERT INTO adocao (data, status,fk_id_usuario)  VALUES (:data, :status,:idUsuario)'
            );

            $stmt->bindValue(':idUsuario', $adocao->getFk_id_usuario());
            $stmt->bindValue(':data', $adocao->getdata());
            $stmt->bindValue(':status', $adocao->getstatus());
            
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
                $adocao = new $adocao();

                $adocao->setid_adocao($row->id_adocao);
                $adocao->setNome($row->nome);
                $adocao->setSerie($row->serie);
                $adocao->setDeleted($row->deleted);

                $resultados[] = $adocao;
            }
        }

        return $resultados;
    }

    public function remover(int $id) {
        $this->conn->beginTransaction();

        try {

            $stmt = $this->conn->prepare(
                    'UPDATE tccadocao.adocao SET deleted=1 WHERE id_adocao=:idInserido'
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