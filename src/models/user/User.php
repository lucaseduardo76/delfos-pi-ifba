<?php
class User
{

    private $id;
    private $nome;
    private $email;
    private $senha;
    private $telefone;
    private $linkFoto;

    public function __construct($nome, $senha, $email, $telefone, $linkFoto)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->telefone = $telefone;
        $this->linkFoto = $linkFoto;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getLinkFoto()
    {
        return $this->linkFoto;
    }

    public function setLinkFoto($linkFoto)
    {
        $this->linkFoto = $linkFoto;
    }


}