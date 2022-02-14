<?php

class listaadotados {
 
    private $id_animais;
    private $nome;
    private $tipo;
    private $tipoanimal;
    private $status;
    private $local;
    private $deleted;
    private $fk_id_adocao;
    private $imagem;
    private $descricao;
    private $imagemextensao;
    private Adocao $Adocao;
    private $id_adocao;
    private $data;
    private $StatusAdocao;
    private $fk_id_usuario;
    private $nomeusuario;
    private $endereco;
    private $email;
 
    
    function getNomeusuario() {
        return $this->nomeusuario;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getEmail() {
        return $this->email;
    }

    function setNomeusuario($nomeusuario): void {
        $this->nomeusuario = $nomeusuario;
    }

    function setEndereco($endereco): void {
        $this->endereco = $endereco;
    }

    function setEmail($email): void {
        $this->email = $email;
    }

        
    function getId_animais() {
        return $this->id_animais;
    }

    function getNome() {
        return $this->nome;
    }

    function getTipoanimal() {
        return $this->tipoanimal;
    }
    
    function getTipo() {
        return $this->tipo;
    }

    function getStatus() {
        return $this->status;
    }

    function getLocal() {
        return $this->local;
    }

    function getDeleted() {
        return $this->deleted;
    }

    function getFk_id_adocao() {
        return $this->fk_id_adocao;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getImagemextensao() {
        return $this->imagemextensao;
    }

    function getAdocao(): Adocao {
        return $this->Adocao;
    }

    function getId_adocao() {
        return $this->id_adocao;
    }

    function getData() {
        return $this->data;
    }

    function getStatusAdocao() {
        return $this->StatusAdocao;
    }

    function getFk_id_usuario() {
        return $this->fk_id_usuario;
    }

    function setId_animais($id_animais): void {
        $this->id_animais = $id_animais;
    }

    function setNome($nome): void {
        $this->nome = $nome;
    }

    function setTipo($tipo): void {
        $this->tipo = $tipo;
    }
    
        function setTipoanimal($tipoanimal): void {
        $this->tipoanimal = $tipoanimal;
    }

    function setStatus($status): void {
        $this->status = $status;
    }

    function setLocal($local): void {
        $this->local = $local;
    }

    function setDeleted($deleted): void {
        $this->deleted = $deleted;
    }

    function setFk_id_adocao($fk_id_adocao): void {
        $this->fk_id_adocao = $fk_id_adocao;
    }

    function setImagem($imagem): void {
        $this->imagem = $imagem;
    }

    function setDescricao($descricao): void {
        $this->descricao = $descricao;
    }

    function setImagemextensao($imagemextensao): void {
        $this->imagemextensao = $imagemextensao;
    }

    function setAdocao(Adocao $Adocao): void {
        $this->Adocao = $Adocao;
    }

    function setId_adocao($id_adocao): void {
        $this->id_adocao = $id_adocao;
    }

    function setData($data): void {
        $this->data = $data;
    }

    function setStatusAdocao($StatusAdocao): void {
        $this->StatusAdocao = $StatusAdocao;
    }

    function setFk_id_usuario($fk_id_usuario): void {
        $this->fk_id_usuario = $fk_id_usuario;
    }


}



 


