<?php

class Animais {
 
    private $id_animais;
    private $nome;
    private $tipoanimal;
    private $status;
    private $local;
    private $deleted;
    private $fk_id_adocao;
    private $imagem;
    private $descricao;
    private $imagemextensao;
    private Adocao $Adocao;
    

    
    function getDescricao() {
        return $this->descricao;
    }

    function setDescricao($descricao): void {
        $this->descricao = $descricao;
    }

        function getId_animais() {
        return $this->id_animais;
    }

    function getNome() {
        return $this->nome;
    }

    function getTipo() {
        return $this->tipoanimal;
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

    function getImagemextensao() {
        return $this->imagemextensao;
    }

    function getAdocao(): Adocao {
        return $this->Adocao;
    }

    function setId_animais($id_animais): void {
        $this->id_animais = $id_animais;
    }

    function setNome($nome): void {
        $this->nome = $nome;
    }

    function setTipo($tipo): void {
        $this->tipoanimal = $tipo;
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

    function setImagemextesao($imagemextensao): void {
        $this->imagemextensao = $imagemextensao;
    }

    function setAdocao(Adocao $Adocao): void {
        $this->Adocao = $Adocao;
    }






}



 


