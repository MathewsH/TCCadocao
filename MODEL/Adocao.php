<?php

class Adocao {
 
    private $id_adocao;
    private $data;
    private $status;
    private $deleted;
    private $fk_id_usuario;
    private Usuario $usuario;
    

    function getId_adocao() {
        return $this->id_adocao;
    }

    function getData() {
        return $this->data;
    }

    function getStatus() {
        return $this->status;
    }

    function getDeleted() {
        return $this->deleted;
    }

    function getFk_id_usuario() {
        return $this->fk_id_usuario;
    }

    function getUsuario(): Usuario {
        return $this->usuario;
    }

    function setId_adocao($id_adocao): void {
        $this->id_adocao = $id_adocao;
    }

    function setData($data): void {
        $this->data = $data;
    }

    function setStatus($status): void {
        $this->status = $status;
    }

    function setDeleted($deleted): void {
        $this->deleted = $deleted;
    }

    function setFk_id_usuario($fk_id_usuario): void {
        $this->fk_id_usuario = $fk_id_usuario;
    }

    function setUsuario(Usuario $usuario): void {
        $this->usuario = $usuario;
    }




}



 



