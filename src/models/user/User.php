<?php
class User
{

    private $id;
    private $nome;
    private $email;
    private $senha;
    private $telefone;
    private $linkFoto;
    private $cpf;
    private $token;
    
    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
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

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }


}


interface UserDaoMySql
{
    public function insert(User $u);
    public function findAll();
    public function findById($id);
    public function findByName($id);

    public function findByEmail($id);
    public function update(User $u);
    public function delete($id);
}