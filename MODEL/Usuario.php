<?php

class Usuario {
 
    private $id_usuario;
    private $nomeusuario;
    private $telefone;
    private $email;
    private $senha;
    private $deleted;
    private $endereco;
    private $tipo;
    
    
    function getEndereco() {
        return $this->endereco;
    }

    function setEndereco($endereco): void {
        $this->endereco = $endereco;
    }

        
    function getDeleted() {
        return $this->deleted;
    }

    function setDeleted($deleted): void {
        $this->deleted = $deleted;
    }

        
    function getTipo() {
        return $this->tipo;
    }

    function setTipo($tipo): void {
        $this->tipo = $tipo;
    }

    
    function getId_usuario() {
        return $this->id_usuario;
    }

    function setId_usuario($id_usuario): void {
        $this->id_usuario = $id_usuario;
    }

    function getNomeusuario() {
        return $this->nomeusuario;
    }

    function setNomeusuario($nomeusuario): void {
        $this->nomeusuario = $nomeusuario;
    }

    
    function getTelefone(){
        return $this->telefone;
    }

    function setTelefone($telefone): void{
        $this->telefone = $telefone;
    }

    function getEmail() {
        return $this->email;
    }

    function setEmail($email): void {
        $this->email = $email;
    }

    function getSenha() {
        return $this->senha;
    }

    function setSenha($senha): void {
        $this->senha = $senha;
    }

    


}



 



